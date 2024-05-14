<?php

namespace App\Entity;

use App\Repository\AlumnosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnosRepository::class)]
class Alumnos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $correo = null;

    #[ORM\Column(length: 255)]
    private ?string $telefono = null;
    
    #[ORM\Column(length: 255)]
    private ?string $deportes = null;

    #[ORM\ManyToMany(targetEntity: Clases::class, mappedBy: 'deporte_alumnos')]
    private Collection $clase_deporte;



    public function __construct()
    {
        $this->clase_deporte = new ArrayCollection();
    }

  



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): static
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    


    /**
     * @return Collection<int, Clases>
     */
    public function getClaseDeporte(): Collection
    {
        return $this->clase_deporte;
    }

    public function addClaseDeporte(Clases $claseDeporte): static
    {
        if (!$this->clase_deporte->contains($claseDeporte)) {
            $this->clase_deporte->add($claseDeporte);
            $claseDeporte->addDeporteAlumno($this);
        }

        return $this;
    }

    public function removeClaseDeporte(Clases $claseDeporte): static
    {
        if ($this->clase_deporte->removeElement($claseDeporte)) {
            $claseDeporte->removeDeporteAlumno($this);
        }

        return $this;
    }

    public function getDeportes(): ?string
    {
        return $this->deportes;
    }

    public function setDeportes(string $deportes): static
    {
        $this->deportes = $deportes;

        return $this;
    }

  
        




}
