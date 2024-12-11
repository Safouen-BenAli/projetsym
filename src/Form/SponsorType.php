<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Sponsor;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SponsorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSP')
            ->add('dateDebutSP', null, [
                'widget' => 'single_text'
            ])
            ->add('montantContrat')
            ->add('dateFinSP', null, [
                'widget' => 'single_text'
            ])
            ->add('NomEV', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'NomEv',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sponsor::class,
        ]);
    }
}
