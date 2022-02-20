<?php

namespace App\Form;

use App\Entity\Marques;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class MarquesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_marque', TextType::class, [
                "label" => "Nom de la marque"
            ])
            ->add('descr_marque', TextareaType::class, [
                "required" => false, 
                'label' => 'Descriptif', 
                'help' => "<br> vaut un saut de ligne",
                "attr" => [
                    'rows'=>'5'
                ]
                ])
                ->add('resume_marque', TextareaType::class, [
                    "required" => false, 
                    'label' => 'Résumé', 
                    'help' => "<br> vaut un saut de ligne",
                    "attr" => [
                        'rows'=>'5'
                    ]
            ])
            ->add('logo_marque', FileType::class, [
                "label" => "Logo de la marque", 
                "required" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "mapped"=> false,
                "attr" => [
                    'lang'=>'fr', 
                    'class' => 'form-control-file'
                ], 
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'maxSizeMessage' => "Votre fichier est trop grand. Merci de charger un fichier de moins de 10Mo.",
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                            'image/svg+xml',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Merci de télécharger vos fichiers avec une extension .png, .jpg, .jpeg, .svg ou .gif',
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Marques::class,
        ]);
    }
}



