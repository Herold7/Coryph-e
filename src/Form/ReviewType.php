<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Artist;
use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                    new Regex ([
                        'pattern' => '/^[a-zA-Z0-9]+$/',
                        'message' => 'Le titre ne doit contenir que des lettres et des chiffres'
                    ]),
                ]
            ])
            ->add('comment', TextareaType::class, [
                'label' => 'Commentaire',
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Renseignez un commentaire'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[a-zA-Z0-9_ .;,:""]+$/u',
                        'message' => 'Votre commentaire ne doit contenir que des lettres, des chiffres, des espaces et des caractères de ponctuations.'
                    ]),
                ]
            ])
            ->add('rating', ChoiceType::class, [
                'choices' => [
                'sélectionnez' => '',
                '★' => 1,
                '★★' => 2,
                '★★★' => 3,
                '★★★★' => 4,
                '★★★★★' => 5,
            ],
                'attr' => [
                    'class' => 'form-control mb-2',
                    'placeholder' => 'Renseignez une note'
                ],
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
