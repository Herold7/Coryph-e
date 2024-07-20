<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Artist;
use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Renseignez un titre'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner un titre'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le titre doit contenir au moins {{ limit }} caractères',
                        'max' => (50),
                        'maxMessage' => 'Le titre doit contenir au maximum {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Renseignez un commentaire'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le commentaire doit contenir au moins {{ limit }} caractères',
                        'max' => (500),
                        'maxMessage' => 'Le commentaire doit contenir au maximum {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('rating', IntegerType::class, [
                'label' => 'Note',
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Renseignez une note'
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'La note doit contenir au moins {{ limit }} caractères',
                        'max' => 5,
                        'maxMessage' => 'La note doit contenir au maximum {{ limit }} caractères'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
