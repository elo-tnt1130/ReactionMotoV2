<?php

namespace App\Form;

use App\Entity\Ets;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('texte_accueil', TextareaType::class, [
                'label' => 'Texte de présentation',
                'help' => '<br> vaut un saut de ligne',
                'attr' => [
                    'rows' => '10'
                ]
            ])
            ->add('tel_ets', TextType::class, [
                'help' => 'Entrer un numéro de téléphone avec séparateur : espace, point, tiret, etc.',
                'label' => 'Téléphone de l\'entreprise',
                'attr' => [
                    'pattern' => '(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}'
                ]
            ])
            ->add('fax_ets', TextType::class, [
                'label' => 'Fax',
                'required' => false,
                'help' => 'Entrer un numéro de fax avec séparateur : espace, point, tiret, etc.',
                'attr' => [
                    'pattern' => '(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}'
                ]
            ])
            ->add('mail1_ets', EmailType::class, [
                'label' => 'Adresse email principale',
                'attr' => [
                    'pattern' => '[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+', 
                    'placeholder' => 'name@example.com'
                ]
            ])
            ->add('mail2_ets', EmailType::class, [
                'label' => 'Adresse email secondaire', 
                'required' => false,
                'attr' => [
                    'pattern' => '[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+', 
                    'placeholder' => 'name2@example.com'
                ]
            ])
            ->add('horaires', TextareaType::class, [
                'label' => 'Horaires', 
                'help' => 'Ne pas retirer les <br> en fin de ligne',
                'attr' => [
                    'rows' => '6'
                ]
            ])
            ->add('adresse_ets', TextType::class, [
                'label' => "Numéro et rue"
            ])
            ->add('cp_ets', TextType::class, [
                'label' => "Code postal",
                'attr' => [
                    'pattern' => '^[\d]+', 
                ]
            ])
            ->add('ville_ets', TextType::class, [
                'label' => "Ville",
                'attr' => [
                    'pattern' => "^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-']?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-']?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-']?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ets::class,
        ]);
    }
}
