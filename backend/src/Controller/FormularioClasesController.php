<?php
// src/Controller/ForoController.php
namespace App\Controller;

use App\Entity\Clases;
use App\Form\ClasesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormularioClasesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/formularioclases', name: 'app_formularioclases')]
    public function formularioclases(Request $request, EntityManagerInterface $entityManager): Response {
        $foro = new Clases();
        $form = $this->createForm(ClasesType::class, $foro);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener los datos del formulario
          
            $dia = $form->get('dia')->getData();
            
            $hora = $form->get('hora')->getData();
            $deporte = $form->get('deporte')->getData();
            $entrenador = $form->get('entrenador')->getData();
            
            // Verificar si el título no está vacío antes de guardarlo en la entidad
            if (!empty($deporte)) {
                $foro->setdeporte($deporte);
            } else {
                // Manejar el caso en que el título esté vacío (opcional)
                // Puedes lanzar una excepción, mostrar un mensaje de error, etc.
            }
            
            // Establecer otros campos del formulario en la entidad
            $foro->sethora($hora);
            $foro->setdia($dia);
            $foro->setdeporte($deporte);
            $foro->setentrenador($entrenador);
            // Persistir el objeto Foro en la base de datos
            $entityManager->persist($foro);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_clases');

        }
    
        // Si el formulario no ha sido enviado o no es válido, renderizar el formulario de registro
        return $this->render('FormularioClases.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }  
    
    
}  

