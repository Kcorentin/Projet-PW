<?php

namespace App\Entity;

use App\Repository\FavorisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavorisRepository::class)]
class Favoris
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\ManyToOne(inversedBy: 'favoris')]
    #[ORM\JoinColumn(nullable: false)]
    private ?BiensImmobiliers $biens = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBiens(): ?BiensImmobiliers
    {
        return $this->biens;
    }

    public function setBiens(?BiensImmobiliers $biens): self
    {
        $this->biens = $biens;

        return $this;
    }
}
