<?php

namespace App\Form;

use App\Entity\Forfaits;
use App\Entity\Services;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ForfaitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_forfait', TextType::class, [
                "label" => "Nom du forfait"
            ])
            ->add('descr_forfait', TextareaType::class, [
                "required" => false, 
                'label' => 'Contenu du forfait'
            ])
            ->add('prix_forfait', NumberType::class, [
                'label'=> 'Prix du forfait'
            ])
            ->add('services', EntityType::class, [
                'choice_label'=>'lib_service', 
                'label'=>'Service lié', 
                'class'=>Services::class   
                // 'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Forfaits::class,
        ]);
    }
}
