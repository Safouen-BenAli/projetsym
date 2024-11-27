<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomFO = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionFO = null;

    #[ORM\Column(length: 255)]
    private ?string $niveauFO = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFO(): ?string
    {
        return $this->nomFO;
    }

    public function setNomFO(string $nomFO): static
    {
        $this->nomFO = $nomFO;

        return $this;
    }

    public function getDescriptionFO(): ?string
    {
        return $this->descriptionFO;
    }

    public function setDescriptionFO(string $descriptionFO): static
    {
        $this->descriptionFO = $descriptionFO;

        return $this;
    }

    public function getNiveauFO(): ?string
    {
        return $this->niveauFO;
    }

    public function setNiveauFO(string $niveauFO): static
    {
        $this->niveauFO = $niveauFO;

        return $this;
    }
}
