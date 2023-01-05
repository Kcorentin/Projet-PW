<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: BiensImmobiliers::class, orphanRemoval: true)]
    private Collection $biensImmobiliers;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: BiensRecherche::class)]
    private Collection $typedebiens;

    public function __construct()
    {
        $this->biensImmobiliers = new ArrayCollection();
        $this->typedebiens = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, BiensImmobiliers>
     */
    public function getBiensImmobiliers(): Collection
    {
        return $this->biensImmobiliers;
    }

    public function addBiensImmobilier(BiensImmobiliers $biensImmobilier): self
    {
        if (!$this->biensImmobiliers->contains($biensImmobilier)) {
            $this->biensImmobiliers->add($biensImmobilier);
            $biensImmobilier->setType($this);
        }

        return $this;
    }

    public function removeBiensImmobilier(BiensImmobiliers $biensImmobilier): self
    {
        if ($this->biensImmobiliers->removeElement($biensImmobilier)) {
            // set the owning side to null (unless already changed)
            if ($biensImmobilier->getType() === $this) {
                $biensImmobilier->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, BiensRecherche>
     */
    public function getTypedebiens(): Collection
    {
        return $this->typedebiens;
    }

    public function addTypedebien(BiensRecherche $typedebien): self
    {
        if (!$this->typedebiens->contains($typedebien)) {
            $this->typedebiens->add($typedebien);
            $typedebien->setType($this);
        }

        return $this;
    }

    public function removeTypedebien(BiensRecherche $typedebien): self
    {
        if ($this->typedebiens->removeElement($typedebien)) {
            // set the owning side to null (unless already changed)
            if ($typedebien->getType() === $this) {
                $typedebien->setType(null);
            }
        }

        return $this;
    }
}
