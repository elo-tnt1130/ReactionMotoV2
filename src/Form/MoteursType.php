<?php

namespace App\Form;

use App\Entity\Moteurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoteursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cylindree', IntegerType::class, [
                'label'=>'Cylindrée du moteur en cm3'
            ])
            ->add('puissance_ch', TextType::class, [
                'label'=>'Puissance du moteur en ch din', 
                "required" => false
            ])
            ->add('couple_nm', TextType::class, [
                'label'=>'Couple du moteur en Nm', 
                "required" => false
            ])
            ->add('RegimeMoteurPuissance', IntegerType::class, [
                'label' => 'Régime moteur (puissance) en tours par minute', 
                "required" => false
            ])
            ->add('RegimeMoteurCouple', IntegerType::class, [
                'label' => 'Régime moteur (couple) en tours par minute', 
                "required" => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Moteurs::class,
        ]);
    }
}
