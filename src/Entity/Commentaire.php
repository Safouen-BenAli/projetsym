<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $conteneu = null;

    #[ORM\Column(length: 255)]
    private ?string $auteurCO = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Datecommentaitre = null;

    #[ORM\Column(length: 255)]
    private ?string $emailCO = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Blog $blog = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConteneu(): ?string
    {
        return $this->conteneu;
    }

    public function setConteneu(string $conteneu): static
    {
        $this->conteneu = $conteneu;

        return $this;
    }

    public function getAuteurCO(): ?string
    {
        return $this->auteurCO;
    }

    public function setAuteurCO(string $auteurCO): static
    {
        $this->auteurCO = $auteurCO;

        return $this;
    }

    public function getDatecommentaitre(): ?\DateTimeInterface
    {
        return $this->Datecommentaitre;
    }

    public function setDatecommentaitre(\DateTimeInterface $Datecommentaitre): static
    {
        $this->Datecommentaitre = $Datecommentaitre;

        return $this;
    }

    public function getEmailCO(): ?string
    {
        return $this->emailCO;
    }

    public function setEmailCO(string $emailCO): static
    {
        $this->emailCO = $emailCO;

        return $this;
    }

    public function getBlog(): ?Blog
    {
        return $this->blog;
    }

    public function setBlog(?Blog $blog): static
    {
        $this->blog = $blog;

        return $this;
    }
}
