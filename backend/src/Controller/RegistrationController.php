<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class RegistrationController extends AbstractController
{

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Codificar la contraseña
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Guardar otros campos del formulario en la entidad User
            $user->setDireccion($form->get('direccion')->getData());
            $user->setTelefono($form->get('telefono')->getData());
            $user->setNombre($form->get('nombre')->getData());
            $user->setApellidos($form->get('apellidos')->getData());

            // Asignar roles al usuario
            $roles = ['ROLE_USER']; // Por defecto, todos los usuarios tienen el rol ROLE_USER
            if ($form->get('roles')->getData()) {
                $roles = $form->get('roles')->getData();
            }
            $user->setRoles($roles);
             

            // Aquí es donde obtenemos el valor del campo 'deportes' y lo guardamos en la entidad User
            $deportes = $form->get('deportes')->getData();
            $user->setDeportes($deportes);

            // Persistir el usuario en la base de datos
            $entityManager->persist($user);
            $entityManager->flush();

            // Redirigir al usuario a la página de inicio de sesión
            return $this->redirectToRoute('app_inicio');
        }

        // Si el formulario no ha sido enviado o no es válido, renderizar el formulario de registro
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
