<?php
// src/Controller/ProductController.php
namespace App\Controller;

// ...
use App\Entity\Contactos;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactoController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }   


    #[Route('/contactos', name: 'app_contactos')]
    public function indexcomunidad(): Response
    {
        $clienteRepository = $this->em->getRepository(Contactos::class);
        return $this->render('contact.html.twig', [
            "resultados" => $clienteRepository->findAll()
        ]);
    }

   
}

