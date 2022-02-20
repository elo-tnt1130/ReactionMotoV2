<?php

namespace App\Form;

use App\Entity\Images;
use App\Entity\Pages;
use App\Entity\Services;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_page', TextType::class, [
                "label" => "Titre de la page"
            ])
            ->add('bloc1', TextareaType::class, [
                "required" => false,
                'label' => 'Bloc de texte 1',
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows' => '5'
                ]
            ])
            ->add('bloc2', TextareaType::class, [
                "required" => false,
                'label' => 'Bloc de texte 2',
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows' => '5'
                ]
            ])
            ->add('bloc3', TextareaType::class, [
                "required" => false,
                'label' => 'Bloc de texte 3',
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows' => '5'
                ]
            ])
            ->add('bloc4', TextareaType::class, [
                "required" => false,
                'label' => 'Bloc de texte 4',
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows' => '5'
                ]
            ])
            ->add('services', EntityType::class, [
                'choice_label' => 'lib_service',
                'label' => 'Catégorie de la page',
                'class' => Services::class,
                // "required" => false
            ])
            ->add('metadescr', TextareaType::class, [
                "label" => "Description de la page", 
                "required" => false
            ])
            ->add('metakw', TextType::class, [
                "label" => "Mots clefs de la page", 
                "required" => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pages::class,
        ]);
    }
}
