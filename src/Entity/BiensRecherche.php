<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\BiensRechercheRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiensRechercheRepository::class)]
class BiensRecherche
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $ville = null;

    #[ORM\Column(nullable: true)]
    private ?int $codepostal = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $superficie = null;

    #[ORM\ManyToOne(inversedBy: 'typedebiens')]
    private ?Categories $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(?int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(?string $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getType(): ?Categories
    {
        return $this->type;
    }

    public function setType(?Categories $type): self
    {
        $this->type = $type;

        return $this;
    }
}
