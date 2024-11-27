<?php

namespace App\Entity;

use App\Repository\ProgressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgressRepository::class)]
class Progress
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $scorePR = null;

    #[ORM\Column(length: 255)]
    private ?string $etatPR = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScorePR(): ?int
    {
        return $this->scorePR;
    }

    public function setScorePR(int $scorePR): static
    {
        $this->scorePR = $scorePR;

        return $this;
    }

    public function getEtatPR(): ?string
    {
        return $this->etatPR;
    }

    public function setEtatPR(string $etatPR): static
    {
        $this->etatPR = $etatPR;

        return $this;
    }
}
