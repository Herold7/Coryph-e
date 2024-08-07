<?php

namespace App\Form;

use App\Entity\Artist;
use App\Entity\Audio;
use App\Entity\Picture;
use App\Entity\Video;
use App\Entity\Website;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('picture', EntityType::class, [
                'class' => Picture::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('video', EntityType::class, [
                'class' => Video::class,
                'choice_label' => 'name', 
                'multiple' => true,
            ])
            ->add('audio', EntityType::class, [
                'class' => Audio::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('website', EntityType::class, [
                'class' => Website::class,
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
