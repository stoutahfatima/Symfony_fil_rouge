<?php

namespace App\Entity;

use App\Repository\LivraisonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivraisonRepository::class)
 */
class Livraison
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $num_bon;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $etat;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="livraison")
     */
    private $commande;

    /**
     * @ORM\OneToMany(targetEntity=Envoyer::class, mappedBy="Livraison")
     */
    private $envoyers;

    

    public function __construct()
    {
        $this->commande = new ArrayCollection();
        $this->envoyers = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumBon(): ?string
    {
        return $this->num_bon;
    }

    public function setNumBon(?string $num_bon): self
    {
        $this->num_bon = $num_bon;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commande->contains($commande)) {
            $this->commande[] = $commande;
            $commande->setLivraison($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getLivraison() === $this) {
                $commande->setLivraison(null);
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
            $envoyer->setLivraison($this);
        }

        return $this;
    }

    public function removeEnvoyer(Envoyer $envoyer): self
    {
        if ($this->envoyers->removeElement($envoyer)) {
            // set the owning side to null (unless already changed)
            if ($envoyer->getLivraison() === $this) {
                $envoyer->setLivraison(null);
            }
        }

        return $this;
    }

}
