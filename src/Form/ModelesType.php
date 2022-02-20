<?php

namespace App\Form;

use App\Entity\AidesConduite;
use App\Entity\Couleurs;
use App\Entity\Marques;
use App\Entity\Modeles;
use App\Entity\Moteurs;
use App\Entity\Permis;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ModelesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib_modele', TextType::class, [
                "label" => "Nom commercial du modèle"
            ])

            ->add('descr_neuf', TextareaType::class, [
                'label' => 'Description du modèle', 
                'required' => false, 
                "attr" => [
                    'rows' => "6", 
                ]
            ])

            ->add('prix_moto', NumberType::class, [
                'label' => 'Prix du véhicule'
            ])

            ->add('longueur_neuf', IntegerType::class, [
                'label' => 'Longueur du véhicule (mm)', 
                'required' => false
            ])

            ->add('largeur_neuf', IntegerType::class, [
                'label' => 'Largeur du véhicule (mm)', 
                'required' => false
            ])

            ->add('hauteur_selle_neuf', IntegerType::class, [
                'label' => 'Hauteur de selle du véhicule (mm)', 
                'required' => false
            ])

            ->add('conso_neuf', NumberType::class, [
                'label' => 'Consommation du véhicule (L/100km)', 
                'required' => false
            ])

            ->add('poids_neuf', IntegerType::class, [
                'label' => 'Poids de la moto en kg', 
                'required' => false
            ])

            ->add('fiche_technique_neuf', FileType::class, [
                "label" => "Fiche technique du véhicule",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .pdf',
                'constraints' => [
                    new File([
                        'maxSize' => '5242880k',
                        'maxSizeMessage' => "Votre fichier est trop grand. Merci de charger un fichier de moins de 4,4 Mo.",
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'text/pdf',
                            'text/x-pdf'
                        ],
                        'mimeTypesMessage' => 'Merci de télécharger vos fichiers avec une extension .pdf',
                    ])
                ],
            ])

            ->add('img1_moto', FileType::class, [
                "label" => "Image principale",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang' => 'fr',
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
                ]
            ])

            ->add('img2_moto', FileType::class, [
                "label" => "Image 2",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang' => 'fr',
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
                ]
            ])

            ->add('img3_moto', FileType::class, [
                "label" => "Image 3",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang' => 'fr',
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
                ]
            ])

            ->add('img4_moto', FileType::class, [
                "label" => "Image 4",
                "required" => false,
                "mapped" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "attr" => [
                    'lang' => 'fr',
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
                ]
            ])

            ->add('descr_occasion', TextareaType::class, [
                'label' => 'Description du modèle', 
                'required' => false, 
                "attr" => [
                    'rows' => "6", 
                ]
            ])

            ->add('lien_occasion', UrlType::class, [
                'label' => "Lien vers l'annonce",
                'help' => "Lien vers leboncoin ou autre plateforme", 
                'required' => false, 
                'empty_data'=>'www.reactionmoto.com'
            ])

            ->add('travaux_occasion', TextareaType::class, [
                'label' => 'Liste des travaux effectués',
                'help' => "<ul> pour obtenir une liste </ul> où <li> text </li> vaut une puce",
                'attr' => [
                    'rows' => "7", 
                    "placeholder" => '
                    <ul>
                        <li>text1</li>
                        <li>text2</li>
                    </ul>'
                ], 
                'required' => false
            ])

            ->add('kilometrage_occasion', TextType::class, [
                "label" => "Kilométrage du véhicule",
                "help" => "Préciser si le kilométrage est garanti ou non. Ex : 17.000km garantis", 
                'required' => false
            ])

            ->add('equipements_occasion', TextareaType::class, [
                'label' => 'Liste des équipements et accessoires du véhicule',
                'help' => "<ul> pour obtenir une liste </ul> où <li> text </li> vaut une puce",
                'attr' => [
                    'rows' => "7",
                    "placeholder" => '
                    <ul>
                        <li>text1</li>
                        <li>text2</li>
                    </ul>'
                ], 
                'required' => false
            ])

            ->add('check_occasion', CheckboxType::class, [
                'label' => 'Occasion',
                'help' => "Cocher si le véhicule est un véhicule d'occasion", 
                'required' => false
            ])

            ->add('marque', EntityType::class, [
                'choice_label' => 'lib_marque',
                'label' => 'Marque du véhicule',
                'class' => Marques::class
            ])
            ->add('moteur', EntityType::class, [
                // 'choice_label' => 'cylindree',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->orderBy('m.cylindree', 'ASC');},
                'required' => false,
                'label' => 'Cylindrée en cm3',
                'class' => Moteurs::class
            ])
            ->add('permis', EntityType::class, [
                'choice_label' => 'lib_permis',
                'label' => 'Permis minimum requis',
                'class' => Permis::class
            ])
            ->add('couleurs', EntityType::class, [
                'choice_label' => 'lib_couleur',
                'required' => false,
                'label' => 'Couleurs disponibles',
                'class' => Couleurs::class,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('aides_conduite', EntityType::class, [
                'choice_label' => 'lib_aide_conduite',
                'required' => false,
                'label' => 'Aides à la conduite disponibles',
                'class' => AidesConduite::class,
                'multiple' => true,
                'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Modeles::class,
        ]);
    }
}
