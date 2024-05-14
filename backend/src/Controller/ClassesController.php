<?php
// src/Controller/ProductController.php
namespace App\Controller;

// ...
use App\Entity\Clases;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClassesController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    #[Route('/clases', name: 'app_clases')]
    public function indexcomunidad(): Response
    {
        $clasesRepository = $this->em->getRepository(Clases::class);
        $clases = $clasesRepository->findAll();
         
        // Si hay clases, renderiza la plantilla clases.html.twig con las clases
        return $this->render('clases.html.twig', [
            "resultados" => $clasesRepository->findAll(),
            "clases" => $clases
        ]);
    }


    
}
