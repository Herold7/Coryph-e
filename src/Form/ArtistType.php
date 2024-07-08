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
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre pseudo doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre pseudo doit contenir au maximum {{ limit }} caractères'
                    ]),
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
                    new Length([
                        'min' => 1,
                        'minMessage' => 'Le nombre de membre doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Le nombre de membre doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex(
                        [
                            'pattern' => '/^[0-9]+$/',
                            'message' => 'Le nombre de membre ne doit contenir que des chiffres'
                        ]
                    )
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
                    'class' => 'form-control mb-6 form-check',
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
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre ville doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre ville doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_ ]+$/',
                            'message' => 'Votre ville ne doit contenir que des lettres, des chiffres, des espaces et des underscores'
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
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre pays doit contenir au moins {{ limit }} caractères',
                        'max' => 50,
                        'maxMessage' => 'Votre pays doit contenir au maximum {{ limit }} caractères'
                    ]),
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
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre téléphone doit contenir au moins {{ limit }} caractères',
                        'max' => 19,
                        'maxMessage' => 'Votre téléphone doit contenir au maximum {{ limit }} caractères'
                    ]),
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
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre biographie doit contenir au moins {{ limit }} caractères',
                        'max' => 500,
                        'maxMessage' => 'Votre biographie doit contenir au maximum {{ limit }} caractères'
                    ]),
                    new Regex(
                        [
                            'pattern' => '/^[a-zA-Z0-9_ ]+$/',
                            'message' => 'Votre biographie ne doit contenir que des lettres, des chiffres, des espaces et des underscores'
                        ]
                    )
                ]
            ])
            ->add('birthyear', IntegerType::class, [
                'label' => 'Année de naissance',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'L\'année de création'
                ],
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 4,
                        'exactMessage' => 'Votre année de naissance doit contenir exactement {{ limit }} caractères',
                    ]),
                    new Regex([
                        'pattern' => '/^[0-9]+$/',
                        'message' => 'Votre année de naissance ne doit contenir que des chiffres'
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
                'constraints' => [
                    new Date([
                        'message' => 'La date de création doit être une date valide',
                    
                ]),
                    new Length([
                        'min' => 4,
                        'max' => 4,
                        'exactMessage' => 'La date de création doit contenir exactement {{ limit }} caractères',
                        ])
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple'=> true,
                'expanded'=> true,
                'by_reference' => false,
                
            ])
            ->add('musicalStyle', EntityType::class, [
                'class' => MusicalStyle::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
            ->add('ensemble', EntityType::class, [
                'class' => Set::class,
                'required' => false,
                'choice_label' => 'name',
                'multiple'=> true,
                
            ])
            ->add('performance', EntityType::class, [
                'class' => Performance::class,
                'required' => false,
                'choice_label' => 'type',
                'multiple'=> true,
                
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
