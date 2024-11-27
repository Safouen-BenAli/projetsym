<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomEV = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEV = null;

    #[ORM\Column(length: 255)]
    private ?string $lieuEV = null;

    /**
     * @var Collection<int, Sponsor>
     */
    #[ORM\OneToMany(targetEntity: Sponsor::class, mappedBy: 'NomEV')]
    private Collection $sponsors;

    public function __construct()
    {
        $this->sponsors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEV(): ?string
    {
        return $this->nomEV;
    }

    public function setNomEV(string $nomEV): static
    {
        $this->nomEV = $nomEV;

        return $this;
    }

    public function getDateEV(): ?\DateTimeInterface
    {
        return $this->dateEV;
    }

    public function setDateEV(\DateTimeInterface $dateEV): static
    {
        $this->dateEV = $dateEV;

        return $this;
    }

    public function getLieuEV(): ?string
    {
        return $this->lieuEV;
    }

    public function setLieuEV(string $lieuEV): static
    {
        $this->lieuEV = $lieuEV;

        return $this;
    }

    /**
     * @return Collection<int, Sponsor>
     */
    public function getSponsors(): Collection
    {
        return $this->sponsors;
    }

    public function addSponsor(Sponsor $sponsor): static
    {
        if (!$this->sponsors->contains($sponsor)) {
            $this->sponsors->add($sponsor);
            $sponsor->setNomEV($this);
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): static
    {
        if ($this->sponsors->removeElement($sponsor)) {
            // set the owning side to null (unless already changed)
            if ($sponsor->getNomEV() === $this) {
                $sponsor->setNomEV(null);
            }
        }

        return $this;
    }
    public function __toString(): string
{
    return $this->nomEV ?: 'Event';
}

}
