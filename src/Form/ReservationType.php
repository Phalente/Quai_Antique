<?php

namespace App\Form;

use IntlDateFormatter;
use App\Entity\Allergy;
use App\Form\AllergyType;
use App\Entity\Reservation;
use App\Entity\RestaurantHours;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormInterface;

class ReservationType extends AbstractType
{
  private $manager;

  public function __construct(EntityManagerInterface $manager)
  {
    $this->manager = $manager;
  }

  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $now = new \DateTime();
    $timeSlots = $this->getTimeSlots($now);

    $builder
      ->add('Date', DateType::class, [
        'widget' => 'single_text',
        'html5' => true,
        'data' => new \DateTime(),
        'label' => 'Date :',
        'attr' => [
          'class' => 'datepicker',
        ]
      ])
      ->add('Number_of_covers', IntegerType::class, [
        'label' => 'Nombre de couverts :'
      ])
      ->add('Allergies', EntityType::class, [
        'attr' => [
          'class' => 'form-control',
        ],
        'class' => Allergy::class,
        'mapped' => false,
        'multiple' => true,
        'expanded' => true,
        'choice_label' => 'name',
        'by_reference' => false,
        'label' => "Allergies (Facultatif) :",
        'placeholder' => 'Avez-vous des allergies?',
        'required' => false,
        'label_attr' => [
          'class' => 'form-label'
        ],
      ])
      ->add('time_slot', ChoiceType::class, [
        'mapped' => false,
        'multiple' => false,
        'expanded' => true,
        'label' => 'Horaire de reservation :',
        'attr' => [
          'class' => 'form-control d-flex flex-wrap'
        ],
        'choices' => $timeSlots,

      ])
      ->add('submit', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-primary mt-4'
        ]
      ]);


    $formModifier = function (FormInterface $form, \DateTimeInterface $date = null) {
      $timeSlots = $this->getTimeSlots($date);

      $form->add('time-slot', ChoiceType::class, [
        'mapped' => false,
        'multiple' => false,
        'expanded' => true,
        'label' => 'Horaire de reservation',
        'attr' => [
          'class' => 'form-control'
        ],
        'choices' => $timeSlots,
      ]);
    };


    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,
      function (FormEvent $event) use ($formModifier) {
        $form = $event->getForm();
        $reservation = $event->getData();
        $date = $reservation ? $reservation->getDate() : new \DateTime();

        $formModifier($form, $date);
      }
    );

    $builder->get('Date')->addEventListener(
      FormEvents::POST_SUBMIT,
      function (FormEvent $event) use ($formModifier) {
        $form = $event->getForm()->getParent();
        $date = $event->getForm()->getData();

        $formModifier($form, $date);
      }
    );




    /*         $builder->get('Date')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) {
                $form = $event->getForm();
                $data = $event->getData();
                $now = new \DateTime();
                $formOptions = [
                    'mapped' => false,
                    'multiple' => false,
                    'expanded' => true,
                    'label' => 'Horaire de reservation',
                    'attr' => [
                        'class' => 'form-control'
                    ],
                ];
                if ($data && $data->getDate()) {
                    $timeSlots = $this->getTimeSlots($data->getDate());
                    $formOptions['choices'] = $timeSlots;
                } else {
                    $timeSlots = $this->getTimeSlots($now);
                    $formOptions['choices'] = $timeSlots;
                }
                $form->add('time_slot', ChoiceType::class, $formOptions);
            }
        ); */
  }


  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Reservation::class,
    ]);
  }

  private function getTimeSlots(?\DateTimeInterface $day): array
  {
    $dayOfWeek = (null === $day) ? (new \DateTime())->format('l') : $day->format('l');

    $days = array(
      'Monday',
      'Tuesday',
      'Wednesday',
      'Thursday',
      'Friday',
      'Saturday',
      'Sunday',
    );
    $jours = array(
      'Lundi',
      'Mardi',
      'Mercredi',
      'Jeudi',
      'Vendredi',
      'Samedi',
      'Dimanche',
    );
    $daysToJours = str_replace($days, $jours, $dayOfWeek);

    $restaurantHours = $this->manager->getRepository(RestaurantHours::class)->findOneBy([
      'Day' => $daysToJours
    ]);

    if (!$restaurantHours) {
      return [];
    }

    $openingLunch = $restaurantHours->getOpeningLunch();
    $closingLunch = $restaurantHours->getClosingLunch();
    $openingDinner = $restaurantHours->getOpeningDinner();
    $closingDinner = $restaurantHours->getClosingDinner();
    $closingLunch->modify('-1 hours');
    $closingDinner->modify('-1 hours');

    $timeSlots = [];
    $interval = new \DateInterval('PT15M');
    $currentTime = $openingLunch;

    while ($currentTime <= $closingLunch) {
      $timeSlots[$currentTime->format('H:i')] = $currentTime->format('H:i');
      $currentTime->add($interval);
    }

    $currentTime = $openingDinner;

    while ($currentTime <= $closingDinner) {
      $timeSlots[$currentTime->format('H:i')] = $currentTime->format('H:i');
      $currentTime->add($interval);
    }

    return $timeSlots;
  }
}
