<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:produit"})
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     * @Groups({"read:produit"})
     */
    private $caracteristiques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:produit"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *  @Groups({"read:produit"})
     */
    private $stock;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     *  @Groups({"read:produit"})
     */
    private $prixht;

    /**
     * @ORM\ManyToOne(targetEntity=SousCategorie::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     *  @Groups({"read:produit"})
     */
    private $souscategorie;


    /**
     * @ORM\OneToMany(targetEntity=Contenir::class, mappedBy="produits")
     */
    private $contenirs;

    /**
     * @ORM\OneToMany(targetEntity=Approvisionner::class, mappedBy="produits")
     */
    private $approvisionners;

    /**
     * @ORM\OneToMany(targetEntity=Envoyer::class, mappedBy="produits")
     */
    private $envoyers;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->contenirs = new ArrayCollection();
        $this->approvisionners = new ArrayCollection();
        $this->envoyers = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCaracteristiques(): ?string
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(?string $caracteristiques): self
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrixht(): ?string
    {
        return $this->prixht;
    }

    public function setPrixht(?string $prixht): self
    {
        $this->prixht = $prixht;

        return $this;
    }



    public function getSouscategorie(): ?SousCategorie
    {
        return $this->souscategorie;
    }

    public function setSouscategorie(?SousCategorie $souscategorie): self
    {
        $this->souscategorie = $souscategorie;

        return $this;
    }


    /**
     * @return Collection|Contenir[]
     */
    public function getContenirs(): Collection
    {
        return $this->contenirs;
    }

    public function addContenir(Contenir $contenir): self
    {
        if (!$this->contenirs->contains($contenir)) {
            $this->contenirs[] = $contenir;
            $contenir->setProduits($this);
        }

        return $this;
    }

    public function removeContenir(Contenir $contenir): self
    {
        if ($this->contenirs->removeElement($contenir)) {
            // set the owning side to null (unless already changed)
            if ($contenir->getProduits() === $this) {
                $contenir->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Approvisionner[]
     */
    public function getApprovisionners(): Collection
    {
        return $this->approvisionners;
    }

    public function addApprovisionner(Approvisionner $approvisionner): self
    {
        if (!$this->approvisionners->contains($approvisionner)) {
            $this->approvisionners[] = $approvisionner;
            $approvisionner->setProduits($this);
        }

        return $this;
    }

    public function removeApprovisionner(Approvisionner $approvisionner): self
    {
        if ($this->approvisionners->removeElement($approvisionner)) {
            // set the owning side to null (unless already changed)
            if ($approvisionner->getProduits() === $this) {
                $approvisionner->setProduits(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Envoyer[]
     */
    public function getEnvoyers(): Collection
    {
        return $this->envoyers;
    }

    public function addEnvoyer(Envoyer $envoyer): self
    {
        if (!$this->envoyers->contains($envoyer)) {
            $this->envoyers[] = $envoyer;
            $envoyer->setProduits($this);
        }

        return $this;
    }

    public function removeEnvoyer(Envoyer $envoyer): self
    {
        if ($this->envoyers->removeElement($envoyer)) {
            // set the owning side to null (unless already changed)
            if ($envoyer->getProduits() === $this) {
                $envoyer->setProduits(null);
            }
        }

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

   }
