<?php

namespace App\Entity;

use App\Repository\GenrelitteraireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GenrelitteraireRepository::class)]
class Genrelitteraire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'genrelitteraire', targetEntity: Livre::class)]
    private $genre;

    #[ORM\Column(type: 'string', length: 20)]
    private $name;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Livre>
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Livre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
            $genre->setGenrelitteraire($this);
        }

        return $this;
    }

    public function removeGenre(Livre $genre): self
    {
        if ($this->genre->removeElement($genre)) {
            // set the owning side to null (unless already changed)
            if ($genre->getGenrelitteraire() === $this) {
                $genre->setGenrelitteraire(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
