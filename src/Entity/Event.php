<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Vich\Uploadable] 
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The event name cannot be null.")]
    private ?string $nomEV = null;

    #[Vich\UploadableField(mapping: 'event_images', fileNameProperty: 'imageName')]
    #[Assert\File(
        maxSize: "2M",
        mimeTypes: ["image/jpeg", "image/png"],
        mimeTypesMessage: "Please upload a valid image file (JPEG or PNG)."
    )]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $imageName = null;

    #[Assert\NotBlank(message: "The event date cannot be null.")]
    #[Assert\GreaterThan("now", message: "The event date must be in the future.")]
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEV = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "The event location cannot be null.")]
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

    public function setNomEV(string $nomEV): self
    {
        $this->nomEV = $nomEV;

        return $this;
    }

    public function setImageFile(?File $imageFile = null): void
{
    $this->imageFile = $imageFile;

    if (null !== $imageFile) {
        // Use a separate property for tracking updates
        $this->updatedAt = new \DateTimeImmutable();
    }
}

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function getDateEV(): ?\DateTimeInterface
    {
        return $this->dateEV;
    }

    public function setDateEV(\DateTimeInterface $dateEV): self
    {
        $this->dateEV = $dateEV;

        return $this;
    }

    public function getLieuEV(): ?string
    {
        return $this->lieuEV;
    }

    public function setLieuEV(string $lieuEV): self
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

    public function addSponsor(Sponsor $sponsor): self
    {
        if (!$this->sponsors->contains($sponsor)) {
            $this->sponsors->add($sponsor);
            $sponsor->setNomEV($this);
        }

        return $this;
    }

    public function removeSponsor(Sponsor $sponsor): self
    {
        if ($this->sponsors->removeElement($sponsor)) {
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
    
    public function mapAction()
    {
        return $this->render('GestGestionBundle:Default:newMap.html.twig');
    }
}