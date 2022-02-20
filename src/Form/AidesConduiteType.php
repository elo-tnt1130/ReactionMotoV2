<?php

namespace App\Form;

use App\Entity\AidesConduite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AidesConduiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_aide_conduite', TextType::class, [
                "label" => "Nom de l'aide à la conduite", 
                "help" => "ABS, CBS, Traction Control, modes de conduite, etc."
            ])
            // ->add('modeles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AidesConduite::class,
        ]);
    }
}
