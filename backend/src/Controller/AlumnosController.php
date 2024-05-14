<?php
// src/Controller/ProductController.php
namespace App\Controller;

// ...
use App\Entity\Alumnos;
use App\Form\AlumnosType;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AlumnosController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }   

    #[Route('/alumnos', name: 'app_alumnos')]
    public function indexalumno(): Response
    {
        $alumnoRepository = $this->em->getRepository(Alumnos::class);
        return $this->render('alumnos.html.twig', [
            "resultados" => $alumnoRepository->findAll()
        ]);
    }

    #[Route('/alumnos/delete/{id}', name: 'alumnos_delete')]
    public function deletealumnos(EntityManagerInterface $entityManager, int $id): Response
    {
        $alumnos = $entityManager->getRepository(Alumnos::class)->find($id);

        if (!$alumnos) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        try {
            $entityManager->remove($alumnos);
            $entityManager->flush();
            header("Location: http://localhost:8000/alumnos");
            exit;
        } catch (\Exception $e) {
            // Si ocurre un error al intentar eliminar la entidad
            $errorMessage = "No se pudo eliminar el usuario porque hay una relacion." ;
            
            // Imprimir el mensaje de error en lugar de redirigir
            echo $errorMessage;
            exit;
        }

    }

    
    #[Route('/alumnos/edit/{id}', name: 'alumnos_edit')]
    public function updatealumnos(EntityManagerInterface $entityManager,Request $request, int $id): Response
    {
        $alumnos = $entityManager->getRepository(Alumnos::class)->find($id);

        if (!$alumnos) {
            throw $this->createNotFoundException(
                'No empleado found for id ' . $id
            );
        }

        $alumnos->setNombre('New alumnos name!'); // Replace setSomeProperty() with an actual setter method.
        $entityManager->flush();
        $form = $this->createForm(AlumnosType::class, $alumnos); // Assuming you have an EmpleadoType form class
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($alumnos);
            $entityManager->flush();
            header("Location:http://localhost:8000/alumnos");
            exit;
        }

        return $this->render('editalumnos.html.twig', [
            'form' => $form->createView(),
        ]);
       
      
    }

  
}
