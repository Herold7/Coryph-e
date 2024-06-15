<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Audio;
use App\Entity\Category;
use App\Entity\EventPlatform;
use App\Entity\Favorite;
use App\Entity\Instrument;
use App\Entity\MusicalStyle;
use App\Entity\MusicPlatform;
use App\Entity\Performance;
use App\Entity\Picture;
use App\Entity\Set;
use App\Entity\SocialNetwork;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Video;
use App\Entity\Website;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtistType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname')
            ->add('number')
            ->add('professionnal')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('mail')
            ->add('image')
            ->add('bio')
            ->add('birthyear')
            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('updated_at', null, [
                'widget' => 'single_text',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('favorite', EntityType::class, [
                'class' => Favorite::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('musicalStyle', EntityType::class, [
                'class' => MusicalStyle::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('instrument', EntityType::class, [
                'class' => Instrument::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('ensemble', EntityType::class, [
                'class' => Set::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('performance', EntityType::class, [
                'class' => Performance::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('website', EntityType::class, [
                'class' => Website::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('socialNetwork', EntityType::class, [
                'class' => SocialNetwork::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('musicPlatform', EntityType::class, [
                'class' => MusicPlatform::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('eventPlatform', EntityType::class, [
                'class' => EventPlatform::class,
                'choice_label' => 'id',
                'multiple' => true,
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
