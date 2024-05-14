<?php
namespace App\Controller;
//namespace AppBundleController;
// ...

use App\Entity\Clases;
use App\Form\ClasesType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use SymfonyBundleFrameworkBundleControllerAbstractController;
use SymfonyComponentHttpFoundationResponse;

class InicioController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/', name: 'app_inicio')]
    public function index(): Response
    {
        $clienteRepository = $this->em->getRepository(Clases::class);
        return $this->render('index.html.twig', [
            "resultados" => $clienteRepository->findAll()
        ]);
    }





   

  
}