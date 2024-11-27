<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\Sponsor;
use App\Entity\Event;

class SponsorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nomSP', TextType::class, [
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Nom sponsor',
        ])

        ->add('dateDebutSP', DateType::class, [
            'widget' => 'single_text', // Single input for date
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Date de debut', // Optional: Remove the label
        ])
        ->add('dateFinSP', DateType::class, [
            'widget' => 'single_text', // Single input for date
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Date de fin', // Optional: Remove the label
        ])
        ->add('nomEV', EntityType::class, [
            'class' => Event::class,
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'nom event',
            'choice_label' => 'nomEV',

        ])
        ->add('montantContrat', IntegerType::class, [
            'attr' => ['class' => 'form-control'], // Optional class for styling
            'label' => 'Nom montantContrat',
        ])
        ->add('save', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary mt-3'], // Add class for button styling
            'label' => '------ Save ------', // Button text
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsor::class,
        ]);
    }
}
