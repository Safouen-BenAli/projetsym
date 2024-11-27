<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SponsorRepository::class)]
class Sponsor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomSP = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateDebutSP = null;

    #[ORM\Column]
    private ?float $montantContrat = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinSP = null;

    #[ORM\ManyToOne(inversedBy: 'sponsors')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Event $NomEV = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSP(): ?string
    {
        return $this->nomSP;
    }

    public function setNomSP(string $nomSP): static
    {
        $this->nomSP = $nomSP;

        return $this;
    }

    public function getDateDebutSP(): ?\DateTimeInterface
    {
        return $this->dateDebutSP;
    }

    public function setDateDebutSP(\DateTimeInterface $dateDebutSP): static
    {
        $this->dateDebutSP = $dateDebutSP;

        return $this;
    }

    public function getMontantContrat(): ?float
    {
        return $this->montantContrat;
    }

    public function setMontantContrat(float $montantContrat): static
    {
        $this->montantContrat = $montantContrat;

        return $this;
    }

    public function getDateFinSP(): ?\DateTimeInterface
    {
        return $this->dateFinSP;
    }

    public function setDateFinSP(\DateTimeInterface $dateFinSP): static
    {
        $this->dateFinSP = $dateFinSP;

        return $this;
    }

    public function getNomEV(): ?Event
    {
        return $this->NomEV;
    }

    public function setNomEV(?Event $NomEV): static
    {
        $this->NomEV = $NomEV;

        return $this;
    }
}
