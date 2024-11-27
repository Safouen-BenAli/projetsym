<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titreAC = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateAC = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptionAC = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreAC(): ?string
    {
        return $this->titreAC;
    }

    public function setTitreAC(string $titreAC): static
    {
        $this->titreAC = $titreAC;

        return $this;
    }

    public function getDateAC(): ?\DateTimeInterface
    {
        return $this->dateAC;
    }

    public function setDateAC(\DateTimeInterface $dateAC): static
    {
        $this->dateAC = $dateAC;

        return $this;
    }

    public function getDescriptionAC(): ?string
    {
        return $this->descriptionAC;
    }

    public function setDescriptionAC(string $descriptionAC): static
    {
        $this->descriptionAC = $descriptionAC;

        return $this;
    }
}
