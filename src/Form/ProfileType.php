<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [// champ pour définir le nom de l'utilisateur
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre nom',
                ],
            ])
            ->add('corporateName', TextType::class, [// champ pour définir le nom de l'entreprise de l'utilisateur
                'label' => 'Raison sociale',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Le nom de votre organisation',
                    'required' => false
                ],
            ])
            ->add('siret', TextType::class, [// champ pour définir le numéro de SIRET de l'entreprise de l'utilisateur
                'label' => 'SIRET',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Son numéro SIRET',
                    'required' => false,
                ],
            ])
            ->add('phone', TextType::class, [// champ pour définir le numéro de téléphone de l'utilisateur
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre numéro de téléphone'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^0[1-9]([-. ]?[0-9]{2}){4}$/',
                        'message' => 'Votre numéro de téléphone doit être au format français',
                    ]),
                ]
            ])
            ->add('address', TextType::class, [// champ pour définir l'adresse de l'utilisateur
                'label' => 'Adresse',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre adresse',
                    'required' => false,
                ]
            ])
            ->add('additionalAddress', TextType::class, [// champ pour définir l'adresse complémentaire de l'utilisateur
                'label' => 'Adresse complémentaire',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Un complément d\'adresse',
                    'required' => false,
                ]
            ])
            ->add('city', TextType::class, [// champ pour définir la ville de l'utilisateur
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre ville'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/',
                        'message' => 'Votre ville ne doit contenir que des lettres',
                    ]),
                ]
            ])
            ->add('zip', TextType::class, [// champ pour définir le code postal de l'utilisateur
                'label' => 'Code postal',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre code postal'
                ],
            ])
            ->add('country', TextType::class, [// champ pour définir le pays de l'utilisateur
                'label' => 'Pays',
                'attr' => [
                    'class' => 'form-control  mb-4',
                    'placeholder' => 'Votre pays'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/',
                        'message' => 'Votre pays ne doit contenir que des lettres',
                    ]),
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Photo de profil  ',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file mb-4'
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Le fichier est trop gros ({{ size }} {{ suffix }}). La taille maximale est de {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez charger une image valide. Les formats acceptés sont : {{ types }}.',
                    ])
                    ],
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
