<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Favorite;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [// champ pour définir le rôle de l'utilisateur
                'label' => 'Je suis un :',
                'mapped' => false,
                'choices' => [
                    'Artist' => 'user',
                    'Producer' => 'host',
                    'Both' => 'host'
                ],
                ])
            ->add('name', TextType::class, [// champ pour définir le nom de l'utilisateur
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Your name'
                ]
            ])
            ->add('corporateName', TextType::class, [// champ pour définir le nom de l'entreprise de l'utilisateur
                'label' => 'Corporate name',
                'attr' => [
                    'placeholder' => 'Your corporate name'
                ]
            ])
            ->add('siret', TextType::class, [// champ pour définir le numéro de SIRET de l'entreprise de l'utilisateur
                'label' => 'SIRET',
                'attr' => [
                    'placeholder' => 'Your SIRET number'
                ]
            ])
            ->add('phone', TextType::class, [// champ pour définir le numéro de téléphone de l'utilisateur
                'label' => 'Phone',
                'attr' => [
                    'placeholder' => 'Your phone number'
                ]
            ])
            ->add('address', TextType::class, [// champ pour définir l'adresse de l'utilisateur
                'label' => 'Address',
                'attr' => [
                    'placeholder' => 'Your address'
                ]
            ])
            ->add('additionalAddress', TextType::class, [// champ pour définir l'adresse complémentaire de l'utilisateur
                'label' => 'Additional address',
                'attr' => [
                    'placeholder' => 'Your additional address'
                ]
            ])
            ->add('city', TextType::class, [// champ pour définir la ville de l'utilisateur
                'label' => 'City',
                'attr' => [
                    'placeholder' => 'Your city'
                ]
            ])
            ->add('zip', TextType::class, [// champ pour définir le code postal de l'utilisateur
                'label' => 'Zip',
                'attr' => [
                    'placeholder' => 'Your zip code'
                ]
            ])
            ->add('country', TextType::class, [// champ pour définir le pays de l'utilisateur
                'label' => 'Country',
                'attr' => [
                    'placeholder' => 'Your country'
                ]
            ])
            ->add('consent', CheckboxType::class, [// champ pour définir le consentement de l'utilisateur
                'label' => 'I agree to the terms and conditions',
            ])
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('image', FileType::class, [
                'label' => 'Your profile picture',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file mb-2'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                    ],
                    ])
            ->add('favorites', EntityType::class, [
                'class' => Favorite::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
