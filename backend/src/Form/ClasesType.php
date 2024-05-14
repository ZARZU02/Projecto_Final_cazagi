<?php

namespace App\Form;

use App\Entity\Clases;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ClasesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('hora')
        ->add('entrenador')
        ->add('deporte', ChoiceType::class, [
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
        ->add('dia', ChoiceType::class, [
            'label' => 'Dias',
            'choices' => [
                'Lunes' => 'Lunes',
                'Martes' => 'Martes',
                'Miércoles' => 'Miércoles',
                'Jueves' => 'Jueves',
                'Viernes' => 'Viernes',
                'Sábado' => 'Sábado',
                'Domingo' => 'Domingo'
            ],
        ]);

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clases::class,
        ]);
    }
}
