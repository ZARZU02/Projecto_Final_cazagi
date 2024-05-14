<?php
// src/Controller/ForoController.php
namespace App\Controller;

use App\Entity\Alumnos;
use App\Form\FormularioAlumnosType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormularioAlumnoController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/formularioalumnos', name: 'app_formularioalumno')]
    public function formularioalumnos(Request $request, EntityManagerInterface $entityManager): Response {
        $foro = new Alumnos();
        $form = $this->createForm(FormularioAlumnosType::class, $foro);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener los datos del formulario
            $nombre = $form->get('nombre')->getData();
            $apellidos = $form->get('apellidos')->getData();
            $correo = $form->get('correo')->getData();
            $telefono = $form->get('telefono')->getData();
            $deporte = $form->get('deportes')->getData();
    
            // Verificar si el nombre no está vacío antes de guardarlo en la entidad
            if (!empty($nombre)) {
                $foro->setNombre($nombre);
            } else {
                // Manejar el caso en que el nombre esté vacío (opcional)
            }
    
            // Establecer otros campos del formulario en la entidad
            $foro->setNombre($nombre);
            $foro->setApellidos($apellidos);
            $foro->setCorreo($correo);
            $foro->setTelefono($telefono);
            $foro->setDeportes($deporte);
    
            // Persistir el objeto Alumno en la base de datos
            $entityManager->persist($foro);
    
            // Persistir las relaciones entre alumno y clases
            $entityManager->flush();
    
            return $this->redirectToRoute('app_clases');
        }
    
        // Si el formulario no ha sido enviado o no es válido, renderizar el formulario de registro
        return $this->render('FormularioAlumno.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    
    
    
}  

