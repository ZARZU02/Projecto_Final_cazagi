<?php

namespace App\Form;

use App\Entity\Alumnos;
use App\Entity\Clases;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class FormularioAlumnosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('correo')
            ->add('telefono')
            ->add('deportes', ChoiceType::class, [
                'label' => 'Deportes',
                'choices' => [
                    'Body Combat' => 'Body Combat',
                    'Yoga' => 'Yoga',
                    'Cycling' => 'Ciclismo',
                    'Boxing' => 'Boxeo',
                    'Swimming' => 'Natación',
                    'Massage' => 'Masaje',
                ],
            ])

         
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alumnos::class,
        ]);
    }
}
