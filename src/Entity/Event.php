<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Context\ExecutionContext;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

// Assuming $validator is your ValidatorInterface instance
$metadata = new ClassMetadata(Event::class);

// Call the validation method manually



#[ORM\Entity(repositoryClass: EventRepository::class)]  
class Event
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomEV = null;

    #[Assert\NotBlank(message: "The event date cannot be null.")]
    #[Assert\GreaterThan("now" , message:"The creation date must be in the future ")]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEV = null;

    /*protected \DateTimeInterface $deliveryDate;*/
    
    /*#[Assert\Type(
        type: \DateTimeInterface::class,
        message: "The value {{ value }} is not a valid date and time."
    )]*/

   /* #[Assert\Callback]
    public function isvalidateEventDate(): void
    {
        if ($this->dateEV === null) {
            return; // Skip validation if no date is set
        }

        $tomorrow = new \DateTime('tomorrow');
        $tomorrow->setTime(0, 0);

        if ($this->dateEV < $tomorrow) {
            message: "The event date cannot be null.";return;
        }
    }
*/


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
