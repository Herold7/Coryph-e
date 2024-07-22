<?php

namespace App\Form;

use App\Entity\Set;
use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\Instrument;
use App\Entity\Performance;
use App\Entity\MusicalStyle;
use App\Entity\EventPlatform;
use App\Entity\MusicPlatform;
use App\Entity\SocialNetwork;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqualValidator;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {// Formulaire d'inscription d'un artiste
        $builder 
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo',
                'attr' => [
                    'class' => 'form-control  mb-6',
                    'placeholder' => 'Votre pseudo'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_ ]+$/',
                            'message' => 'Votre pseudo ne doit contenir que des lettres, des chiffres, des espaces et des underscores'
                        ]
                    )
                ]
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro',
                'attr' => [
                    'class' => 'form-control  mb-6',
                    'placeholder' => 'Le nombre de membre'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[0-9]+$/',
                            'message' => 'Le nombre de membre ne doit contenir que des chiffres'
                        ]
                        ),
                    new LessThanOrEqual([
                        'value' => 100,
                        'message' => 'Le nombre de membre ne peut pas être supérieure à 100'
                    ])
                ]
            ])
            ->add('professionnal', ChoiceType::class, [
                'label' => 'Professionnel',
                'mapped' => false,
                'choices' => [
                    '<-- sélectionnez l\'une des deux options -->' => null,
                    'Oui' => true,
                    'Non' => false,
                ],
                'attr' => [
                    'class' => 'form-control mb-6 form-switch',
                ],
                'constraints' => [
                    new Choice([
                        'choices' => [true, false],
                        'message' => 'Veuillez sélectionner une option valide',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control  mb-6',
                    'placeholder' => 'Votre ville'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-ZÀ-ÿ_ -\/]+$/u',
                            'message' => 'Le nom de votre ville ne doit contenir que des lettres, des espaces, des tirets et des slashs'
                        ]
                    )
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre pays'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_ ]+$/',
                            'message' => 'Votre pays ne doit contenir que des lettres, des chiffres, des espaces et des underscores'
                        ]
                    )
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre téléphone'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[0-9 .]+$/',
                            'message' => 'Votre téléphone ne doit contenir que des chiffres'
                        ]
                    )
                ]
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre email'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre email doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre email doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_@. ]+$/',
                            'message' => 'Votre email ne doit contenir que des lettres, des chiffres, des espaces, des points et des arobase'
                        ]
                    )
                ]
            ])
            ->add('bio', TextType::class, [
                'label' => 'Biographie',
                'attr' => ['class' => 'form-control  mb-2',
                    'placeholder' => 'Votre biographie'
                ],
                'constraints' => [
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_ .;,:""]+$/u',
                            'message' => 'Votre biographie ne doit contenir que des lettres, des chiffres, des espaces et des caractères de ponctuations.'
                        ]
                    )
                ]
            ])
            ->add('birthyear', IntegerType::class, [
                'label' => 'Année de création',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'L\'année de création'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Votre année de création ne doit contenir que des chiffres'
                    ]),
                    new LessThanOrEqual([
                        'value' => date('Y'),
                        'message' => 'Votre année de création ne peut pas être supérieure à l\'année en cours'
                    ])
                ]
            ])
            ->add('image', FileType::class, [
                'label' => "Photo de l\'artiste",
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
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'label' => 'Date de création',
                'attr' => [
                    'readonly' => true,
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple'=> true,
                'by_reference' => false,
                
            ])
            ->add('musicalStyle', EntityType::class, [
                'class' => MusicalStyle::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                'expanded'=> true,
                
            ])
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                'expanded'=> true,

            ])
            ->add('ensemble', EntityType::class, [
                'class' => Set::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                'expanded'=> true,

            ])
            ->add('performance', EntityType::class, [
                'class' => Performance::class,
                'required' => false,
                'choice_label' => 'type',
                'multiple'=> true,
                'expanded'=> true,

            ])
            ->add('socialNetwork', EntityType::class, [
                'class' => SocialNetwork::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
            ->add('musicPlatform', EntityType::class, [
                'class' => MusicPlatform::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
            ->add('eventPlatform', EntityType::class, [
                'class' => EventPlatform::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,
        ]);
    }
}
