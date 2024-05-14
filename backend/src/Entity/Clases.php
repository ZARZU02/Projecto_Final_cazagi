<?php

namespace App\Entity;

use App\Repository\ClasesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasesRepository::class)]
class Clases
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

 

    #[ORM\Column(length: 255)]
    private ?string $deporte = null;





    #[ORM\Column(length: 255)]
    private ?string $entrenador = null;

    #[ORM\Column(length: 255)]
    private ?string $dia = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hora = null;

    #[ORM\ManyToMany(targetEntity: Alumnos::class, inversedBy: 'clase_deporte')]
    private Collection $deporte_alumnos;

    public function __construct()
    {
        $this->deporte_alumnos = new ArrayCollection();
    }


 


   

    public function getId(): ?int
    {
        return $this->id;
    }

 



  

    public function getDeporte(): ?string
    {
        return $this->deporte;
    }

    public function setDeporte(string $deporte): static
    {
        $this->deporte = $deporte;

        return $this;
    }

  

   

    public function getEntrenador(): ?string
    {
        return $this->entrenador;
    }

    public function setEntrenador(string $entrenador): static
    {
        $this->entrenador = $entrenador;

        return $this;
    }

    public function getDia(): ?string
    {
        return $this->dia;
    }

    public function setDia(string $dia): static
    {
        $this->dia = $dia;

        return $this;
    }

    public function getHora(): ?\DateTimeInterface
    {
        return $this->hora;
    }

    public function setHora(\DateTimeInterface $hora): static
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * @return Collection<int, Alumnos>
     */
    public function getDeporteAlumnos(): Collection
    {
        return $this->deporte_alumnos;
    }

    public function addDeporteAlumno(Alumnos $deporteAlumno): static
    {
        if (!$this->deporte_alumnos->contains($deporteAlumno)) {
            $this->deporte_alumnos->add($deporteAlumno);
        }

        return $this;
    }

    public function removeDeporteAlumno(Alumnos $deporteAlumno): static
    {
        $this->deporte_alumnos->removeElement($deporteAlumno);

        return $this;
    }

   
    
}
