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
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ReservationType extends AbstractType
{
  private $manager;
  private $security;


  public function __construct(EntityManagerInterface $manager, Security $security)
  {
    $this->manager = $manager;
    $this->security = $security;
  }

  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    /**@var User $user */
    $user = $this->security->getUser();

    if ($user !== null && method_exists($user, 'getNbrOfCoversByDefault')) {
      $defaultCovers = $user->getNbrOfCoversByDefault();
    } else {
      $defaultCovers = 1;
    }
    if ($user !== null) {
      $userAllergies = $user->getAllergies()->toArray();
    } else {
      $userAllergies = null;
    }
    $builder->add('Number_of_covers', IntegerType::class, [
      'attr' => [
        'class' => 'form-control',
      ],
      'label' => 'Nombre de convive(s)',
      'label_attr' => [
        'class' => 'form-label'
      ],
      'data' => $defaultCovers
    ])
      ->add('Allergies', EntityType::class, [
        'attr' => [
          'class' => 'form-control',
        ],
        'class' => Allergy::class,
        'choice_label' => 'name',
        'label' => 'Allergies (Facultatif)',
        'mapped' => false,
        'required' => false,
        'multiple' => true,
        'expanded' => true,
        'data' => $userAllergies

      ]);


    $builder
      ->add('Date', DateType::class, [
        'widget' => 'single_text',
        'html5' => true,
        'attr' => [
          'class' => 'datepicker',
        ]
      ])
      ->add('submit', SubmitType::class, [
        'attr' => [
          'class' => 'btn btn-primary mt-4'
        ],
        'label' => 'Réserver'
      ]);

    $formModifier = function (FormInterface $form, ?\DateTimeInterface $date = null) {
      $timeSlots = $this->getTimeSlots($date);



      $form->remove('time_slot');

      $form->add('time_slot', ChoiceType::class, [
        'mapped' => false,
        'multiple' => false,
        'expanded' => true,
        'label' => 'Horaire de reservation',
        'attr' => [
          'class' => 'form-control d-flex flex-wrap'
        ],
        'choices' => $timeSlots,
      ]);
    };

    $builder->get('Date')->addEventListener(
      FormEvents::POST_SUBMIT,
      function (FormEvent $event) use ($formModifier) {
        $form = $event->getForm()->getParent();
        $date = $event->getForm()->getData();

        $formModifier($form, $date);
      }
    );


    $builder->add('time_slot', ChoiceType::class, [
      'mapped' => false,
      'multiple' => false,
      'expanded' => true,
      'label_attr' => [
        'class' => 'form-label d-flex flex-wrap'
      ],
      'label' => 'Horaire de reservation',
      'attr' => [
        'class' => 'form-control d-flex flex-wrap'
      ],
      'choices' => [],

    ]);
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
