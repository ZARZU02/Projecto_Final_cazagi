<?php
// src/Controller/ProductController.php
namespace App\Controller;

// ...
use App\Entity\User;
use App\Form\UserType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }   


    #[Route('/user', name: 'app_user')]
    public function indexuser(): Response
    {
        $clienteRepository = $this->em->getRepository(User::class);
        return $this->render('user.html.twig', [
            "resultados" => $clienteRepository->findAll()
        ]);
    }

   #[Route('/user/delete/{id}', name: 'user_delete')]
    public function deleteuser(EntityManagerInterface $entityManager, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        try {
            $entityManager->remove($user);
            $entityManager->flush();
            header("Location: http://localhost:8000/user");
            exit;
        } catch (\Exception $e) {
            // Si ocurre un error al intentar eliminar la entidad
            $errorMessage = "No se pudo eliminar el usuario porque hay una relacion." ;
            
            // Imprimir el mensaje de error en lugar de redirigir
            echo $errorMessage;
            exit;
        }

    }

    
    #[Route('/user/edit/{id}', name: 'user_edit')]
    public function updateuser(EntityManagerInterface $entityManager,Request $request, int $id): Response
    {
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No empleado found for id ' . $id
            );
        }

        $user->setNombre('New user name!'); // Replace setSomeProperty() with an actual setter method.
        $entityManager->flush();
        $form = $this->createForm(UserType::class, $user); // Assuming you have an EmpleadoType form class
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            header("Location:http://localhost:8000/user");
            exit;
        }

        return $this->render('edituser.html.twig', [
            'form' => $form->createView(),
        ]);
       
      
    }

  
}

