<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('nombre', TextType::class, [
                'label' => 'Nombre',
            ])
            ->add('apellidos', TextType::class, [
                'label' => 'Apellidos',
            ])
            ->add('telefono', TextType::class, [
                'label' => 'Teléfono',
            ])
            ->add('direccion', TextType::class, [
                'label' => 'Dirección',
            ]) 
            ->add('roles', ChoiceType::class, [
                'label' => 'Roles',
                'choices' => [
                    'Usuario' => 'ROLE_USER',
                    'Administrador' => 'ROLE_ADMIN',
                ],
                'multiple' => true, // Para permitir múltiples selecciones de roles
                'expanded' => true, // Para mostrar los roles como botones de opción
                'required' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor, introduce una contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Tu contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Contraseña',
            ])
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
            ]); 

            
            
            
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}