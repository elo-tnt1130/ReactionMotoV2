<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom', 
                'attr' => [
                    'max_lenght' => 100,
                    'min_lenght' => 2,
                    'placeholder' => '...',
                    'pattern'=>"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$",
                    'class'=>'form-control'
                ]
            ])
            
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom', 
                'attr' => [
                    'max_lenght' => 100,
                    'min_lenght' => 2, 
                    'placeholder' => '...',
                    'pattern'=>"^\s*^[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s?[\-]?\s?[a-zA-Zàáâãäåçèéêëìíîïðòóôõöùúûüýÿñ]+\s*$",
                    'class'=>'form-control'
                ]
            ])
            
            ->add('tel', TextType::class, [
                'label' => 'Votre téléphone',
                'attr' => [
                    'pattern' => '^(?:(?:\+|00)33[\s.-]{0,3}(?:\(0\)[\s.-]{0,3})?|0)[1-9](?:(?:[\s.-]?\d{2}){4}|\d{2}(?:[\s.-]?\d{3}){2})$',
                    'class'=>'form-control'
                ]
            ])

            ->add('mail', EmailType::class, [
                'label' => 'Votre e-mail',
                'attr' => [
                    'placeholder' => 'name@example.com',
                    'class'=>'form-control'
                ]
            ])
            
            ->add('subject', TextType::class, [
                'label' => 'Sujet',
                'attr' => [
                    'min_lenght' => 10,
                    'class'=>'form-control'
                ]
            ])
            
            ->add('message', TextareaType::class, [
                'label' => 'Votre message',
                'attr' => [
                    'min_lenght' => 10,
                    'class'=>'form-control', 
                    'rows'=>"4", 
                    'placeholder'=>'Ecrivez votre message ici...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
