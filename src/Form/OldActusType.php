<?php

namespace App\Form;

use App\Entity\OldActus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OldActusType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_actu')
            ->add('date_actu')
            ->add('bloc_texte')
            ->add('img1_actu')
            ->add('img2_actu')
            ->add('img3_actu')
            ->add('video_actu')
            ->add('lien_fb_actu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OldActus::class,
        ]);
    }
}
