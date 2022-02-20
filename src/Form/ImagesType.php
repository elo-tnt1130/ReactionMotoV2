<?php

namespace App\Form;

use App\Entity\Images;
use App\Entity\Pages;
use App\Entity\Services;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;

class ImagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_img', FileType::class, [
                "label" => "Image à télécharger",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang' => 'fr',
                    'class' => 'form-control-file'
                ],
                'constraints' => [
                    new ConstraintsFile([
                        'maxSize' => '209540k',
                        'maxSizeMessage' => "Votre fichier est trop grand. Merci de charger un fichier de moins de 2Mo.",
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/svg+xml',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Merci de télécharger vos fichiers avec une extension .png, .jpg, .jpeg, .svg ou .gif',
                    ])
                ]
            ])
            ->add('descr_img', TextType::class, [
                'label'=>'Description de la photo', 
                'required' => false
            ])
            ->add('services',  EntityType::class, [
                'choice_label' => 'lib_service',
                'label' => 'Service lié',
                'class' => Services::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Images::class,
        ]);
    }
}
