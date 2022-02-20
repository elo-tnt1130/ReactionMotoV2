<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $modification = $options['data']->getId();
        $builder
            ->add('pseudo', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Admin' => 'ROLE_ADMIN',
                    'Dev' => 'ROLE_DEV'
                ],
                'multiple' => true,
                'expanded' => true,
                'label' => 'Rôles'
            ])
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'required' => !$modification,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe ne peut être vide'
                    ])
                ]
            ])
            ->add('prenom_user', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('nom_user',  TextType::class, [
                'label' => 'Nom'
            ])
            ->add('avatar_user', FileType::class, [
                "label" => "Avatar",
                "required" => false,
                "help" => 'Utiliser des fichiers .png, .jpg, .jpeg, .svg ou .gif',
                "mapped" => false,
                "attr" => [
                    'lang' => 'fr',
                    'class' => 'form-control-file'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '10240k',
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
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
