<?php

namespace App\Form;

use App\Entity\Set;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Audio;
use App\Entity\Video;
use App\Entity\Artist;
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
use DateTimeImmutable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Polyfill\Intl\Icu\DateFormat\YearTransformer;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre pseudo'
                ]
            ])
            ->add('number', TextType::class, [
                'label' => 'Numéro',
                'attr' => [
                    'class' => 'form-control  mb-2',
                    'placeholder' => 'Votre numéro'
                ]
            ])
            ->add('professionnal', CheckboxType::class, [
                'label' => 'Professionnel',
                'required' => false,
                'attr' => [
                    'class' => 'form-control  mb-2',
                ]
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'attr' => [
                    'class' => 'form-control  mb-2',
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
            ->add('birthyear', BirthdayType::class, [
                'widget' => 'choice',
                'year' => '1900',
                'label' => 'Année de naissance',
                'attr' => ['class' => 'form-control  mb-2',
                    'placeholder' => 'Votre année de naissance'
                ]
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
            ->add('created_at', DateType::class, [
                'widget' => 'single_text',
                'data' => new \DateTime(),
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expand'=> false,
            ])
            ->add('musicalStyle', EntityType::class, [
                'class' => MusicalStyle::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('ensemble', EntityType::class, [
                'class' => Set::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('performance', EntityType::class, [
                'class' => Performance::class,
                'choice_label' => 'type',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('socialNetwork', EntityType::class, [
                'class' => SocialNetwork::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('musicPlatform', EntityType::class, [
                'class' => MusicPlatform::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
            ])
            ->add('eventPlatform', EntityType::class, [
                'class' => EventPlatform::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expand'=> true,
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
