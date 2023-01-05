<?php

namespace App\Entity;

use App\Entity\Trait\SlugTrait;
use App\Repository\BiensImmobiliersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BiensImmobiliersRepository::class)]
class BiensImmobiliers
{
    use SlugTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $surface = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 200)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $codepostal = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_ajout = null;
    
    #[ORM\ManyToOne(inversedBy: 'biensImmobiliers')]
    #[ORM\JoinColumn(nullable: false,onDelete:'CASCADE')]
    private ?Categories $type = null;

    #[ORM\Column(length: 200)]
    private ?string $VentesOuLocations = null;

    #[ORM\OneToMany(mappedBy: 'biens', targetEntity: Images::class, orphanRemoval: true)]
    private Collection $images;

    #[ORM\OneToMany(mappedBy: 'biens', targetEntity: Favoris::class, orphanRemoval: true)]
    private Collection $favoris;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->favoris = new ArrayCollection();
        $this->date_ajout= new \DateTimeImmutable();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodepostal(): ?int
    {
        return $this->codepostal;
    }

    public function setCodepostal(int $codepostal): self
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateAjout(): ?\DateTimeImmutable
    {
        return $this->date_ajout;
    }

    public function setDateAjout(\DateTimeImmutable $date_ajout): self
    {
        $this->date_ajout = $date_ajout;

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

    public function getVentesOuLocations(): ?string
    {
        return $this->VentesOuLocations;
    }

    public function setVentesOuLocations(string $VentesOuLocations): self
    {
        $this->VentesOuLocations = $VentesOuLocations;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setBiens($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getBiens() === $this) {
                $image->setBiens(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Favoris>
     */
    public function getFavoris(): Collection
    {
        return $this->favoris;
    }

    public function addFavori(Favoris $favori): self
    {
        if (!$this->favoris->contains($favori)) {
            $this->favoris->add($favori);
            $favori->setBiens($this);
        }

        return $this;
    }

    public function removeFavori(Favoris $favori): self
    {
        if ($this->favoris->removeElement($favori)) {
            // set the owning side to null (unless already changed)
            if ($favori->getBiens() === $this) {
                $favori->setBiens(null);
            }
        }

        return $this;
    }
}
