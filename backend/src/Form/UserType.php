<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('direccion')
            ->add('telefono')
            ->add('nombre')
            ->add('apellidos')
            ->add('deportes', ChoiceType::class, [ 
                'label' => 'Deportes',
                'choices' => [
                    'Body Combat' => 'Body Combat',
                    'Yoga' => 'Yoga',
                    'Cycling' => 'Ciclismo',
                    'Boxing' => 'Boxeo',
                    'Swimming' => 'Natación',
                    'Massage' => 'Masaje',
                    'Todos' => 'Todos',
                ],
            ])
            ->add('submit', SubmitType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
