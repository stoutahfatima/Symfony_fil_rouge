<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"showcat"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=SousCategorie::class, mappedBy="Categorie")
     */
    private $sousCategories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photos;

    public function __construct()
    {
        $this->sousCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

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

    /**
     * @return Collection|SousCategorie[]
     */
    public function getSousCategories(): Collection
    {
        return $this->sousCategories;
    }

    public function addSousCategorie(SousCategorie $sousCategorie): self
    {
        if (!$this->sousCategories->contains($sousCategorie)) {
            $this->sousCategories[] = $sousCategorie;
            $sousCategorie->setCategorie($this);
        }

        return $this;
    }

    public function removeSousCategorie(SousCategorie $sousCategorie): self
    {
        if ($this->sousCategories->removeElement($sousCategorie)) {
            // set the owning side to null (unless already changed)
            if ($sousCategorie->getCategorie() === $this) {
                $sousCategorie->setCategorie(null);
            }
        }

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->photos;
    }

    public function setPhotos(?string $photos): self
    {
        $this->photos = $photos;

        return $this;
    }
}
