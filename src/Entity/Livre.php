<?php

namespace App\Entity;

use App\Entity\Pagesearch;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreRepository;

#[ORM\Entity(repositoryClass: LivreRepository::class)]
class Livre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'integer')]
    private $prix;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Genrelitteraire::class, inversedBy: 'genre')]
    #[ORM\JoinColumn(nullable: false)]
    private $genrelitteraire;

    #[ORM\ManyToOne(targetEntity: Auteur::class, inversedBy: 'auteurliaison')]
    #[ORM\JoinColumn(nullable: true)]
    private $auteur;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getGenrelitteraire(): ?Genrelitteraire
    {
        return $this->genrelitteraire;
    }

    public function setGenrelitteraire(?Genrelitteraire $genrelitteraire): self
    {
        $this->genrelitteraire = $genrelitteraire;

        return $this;
    }

    public function getAuteur(): ?Auteur
    {
        return $this->auteur;
    }

    public function setAuteur(?Auteur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }
}
