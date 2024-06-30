<?php

namespace App\Form;

use App\Entity\Set;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Audio;
use App\Entity\Video;
use App\Entity\Artist;
use DateTimeImmutable;
use App\Entity\Picture;
use App\Entity\Website;
use App\Entity\Category;
use App\Entity\Favorite;
use App\Entity\Instrument;
use App\Entity\Performance;
use App\Entity\MusicalStyle;
use App\Entity\EventPlatform;
use App\Entity\MusicPlatform;
use App\Entity\SocialNetwork;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
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
                ]
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro',
                'attr' => [
                    'class' => 'form-control  mb-6',
                    'placeholder' => 'Le nombre de membre'
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
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control  mb-6',
                    'placeholder' => 'Votre ville'
                ]
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre pays'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre téléphone'
                ]
            ])
            ->add('mail', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre email'
                ]
            ])
            ->add('bio', TextType::class, [
                'label' => 'Biographie',
                'attr' => ['class' => 'form-control  mb-2',
                    'placeholder' => 'Votre biographie'
                ]
            ])
            ->add('birthyear', IntegerType::class, [
                
                'label' => 'Année de naissance',
                'attr' => ['class' => 'form-control  mb-2',
                    'placeholder' => 'L\'année de création'
                ]
            ])
                
            ->add('image', FileType::class, [// Ajouter une image
                'label' => 'Your profile picture',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control-file mb-2'
                ],
                'constraints' => [// Contraintes sur le fichier
                    new File([
                        'maxSize' => '2048k',// Taille maximale du fichier
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.',
                        'mimeTypes' => [// Types de fichiers autorisés
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ])
                ],
            ])
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
                'disabled' => true,
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
