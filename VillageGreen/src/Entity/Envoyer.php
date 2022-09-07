<?php

namespace App\Entity;

use App\Repository\EnvoyerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnvoyerRepository::class)
 */
class Envoyer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="envoyers")
     */
    private $produits;

    /**
     * @ORM\ManyToOne(targetEntity=Livraison::class, inversedBy="envoyers")
     */
    private $Livraison;



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProduits(): ?Produit
    {
        return $this->produits;
    }

    public function setProduits(?Produit $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getLivraison(): ?Livraison
    {
        return $this->Livraison;
    }

    public function setLivraison(?Livraison $Livraison): self
    {
        $this->Livraison = $Livraison;

        return $this;
    }
}
