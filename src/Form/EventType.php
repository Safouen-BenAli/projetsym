<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Event;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('NomEV', TextType::class, [
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Nom livre',
        ])

        ->add('dateEv', DateType::class, [
            'widget' => 'single_text', // Single input for date
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Date de creation', // Optional: Remove the label
        ])
        ->add('lieuEV', TextType::class, [
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Nom livre',
        ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary mt-3'], // Add class for button styling
            'label' => '------ Save ------', // Button text
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
