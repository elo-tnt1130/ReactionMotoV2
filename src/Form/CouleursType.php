<?php

namespace App\Form;

use App\Entity\Couleurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CouleursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_couleur', TextType::class, [
                "label" => "Nom de la couleur"
            ])
            ->add('img_color', FileType::class, [
                "label" => "Image de la couleur", 
                "required" => false,
                "mapped"=> false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang'=>'fr', 
                    'class' => 'form-control-file'
                ], 
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
                        'maxSizeMessage' => "Votre fichier est trop grand. Merci de charger un fichier de moins de 4Mo.",
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
            // ->add('modeles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Couleurs::class,
        ]);
    }
}
