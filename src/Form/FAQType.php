<?php

namespace App\Form;

use App\Entity\FAQ;
use App\Entity\ThemesFAQ;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FAQType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', TextType::class, [
                'label'=>"Question"
            ])
            ->add('reponse', TextareaType::class, [
                'label'=>"Réponse", 
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows'=>'5'
                ]
            ])
            ->add('theme_FAQ', EntityType::class, [
                'choice_label'=>'theme_question', 
                'label'=>'Thématique', 
                'class'=>ThemesFAQ::class   
                // 'multiple' => true,
                // 'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FAQ::class,
        ]);
    }
}
