<?php
// src/Controller/ForoController.php
namespace App\Controller;

use App\Entity\Consejos;
use App\Form\ConsejosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormularioConsejosController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/foroconsejos', name: 'app_foro')]
    public function foro(Request $request, EntityManagerInterface $entityManager): Response {
        $foro = new Consejos();
        $form = $this->createForm(ConsejosType::class, $foro);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener los datos del formulario
            $titulo = $form->get('titulo')->getData();
            $descripcion = $form->get('descripcion')->getData();
            
            // Verificar si el título no está vacío antes de guardarlo en la entidad
            if (!empty($titulo)) {
                $foro->setTitulo($titulo);
            } else {
                // Manejar el caso en que el título esté vacío (opcional)
                // Puedes lanzar una excepción, mostrar un mensaje de error, etc.
            }
            
            // Establecer otros campos del formulario en la entidad
            $foro->setDescripcion($descripcion);
            
            // Persistir el objeto Foro en la base de datos
            $entityManager->persist($foro);
            $entityManager->flush();
            
         
            return $this->redirectToRoute('app_consejos');
        }
    
        // Si el formulario no ha sido enviado o no es válido, renderizar el formulario de registro
        return $this->render('FormularioConsejos.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }  
    
    
}  

