<?php

namespace App\Form;

use App\Entity\Allergy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AllergyType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
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
        'label' => "Allergies (Facultatif)",
        'placeholder' => 'Avez-vous des allergies?',
        'required' => false,
        'label_attr' => [
          'class' => 'form-label'
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Allergy::class,
      'label' => false
    ]);
  }
}
