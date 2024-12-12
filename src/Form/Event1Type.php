<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints as Assert;


class Event1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomEV', TextType::class, [
                'label' => 'Event Name',
                'attr' => ['placeholder' => 'Enter event name']
            ])
            ->add('dateEV', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Event Date',
                'attr' => ['placeholder' => 'Select event date']
            ])
            ->add('lieuEV', TextType::class, [
                'label' => 'Location',
                'attr' => ['placeholder' => 'Enter event location']
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Upload an Image',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
    class SearchEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', TextType::class, [
                'required' => false,
                'label' => 'Search by ID',
            ])
            ->add('nomEV', TextType::class, [
                'required' => false,
                'label' => 'Search by Name',
            ])
            ->add('dateEV', TextType::class, [
                'required' => false,
                'label' => 'Search by Date',
            ])
            ->add('lieuEV', TextType::class, [
                'required' => false,
                'label' => 'Search by Location',
            ])
            ->add('Rechercher', SubmitType::class, [
                'label' => 'Rechercher',
            ]);
    }
}
