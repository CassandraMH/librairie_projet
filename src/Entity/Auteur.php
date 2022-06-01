<?php

namespace App\Entity;

use App\Repository\AuteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuteurRepository::class)]
class Auteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nometprenom;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNometprenom(): ?string
    {
        return $this->nometprenom;
    }

    public function setNometprenom(string $nometprenom): self
    {
        $this->nometprenom = $nometprenom;

        return $this;
    }

    public function __toString()
    {
        return $this->nometprenom;
    }


}
