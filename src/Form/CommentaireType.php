<?php

namespace App\Form;

use App\Entity\Blog;
use App\Entity\Commentaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteurCO')
            ->add('conteneu')
            ->add('Datecommentaitre', null, [
                'widget' => 'single_text',
            ])
            ->add('emailCO')
            ->add('blog', EntityType::class, [
                'class' => Blog::class,
                'choice_label' => 'titreBL',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
