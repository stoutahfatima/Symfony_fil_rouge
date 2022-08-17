<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ClientRepository;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function Categories(CategorieRepository $cat, SousCategorieRepository $repo, ClientRepository $cli): Response
    {
        $categories = $cat->findAll();

        return $this->render('accueil/accueil.html.twig', [
            /* $categorie afficher les categories dans la navbar */
            'home' => $categories
        ]);
    }

    /**
     * @Route("/souscategorie/{id}", name="souscategorie")
     */
    public function Souscategories(CategorieRepository $cat, SousCategorieRepository $repo, $id ): Response
    {        
        $categories = $cat->findAll();
        $listesouscategories=$repo->findBy(['categorie'=>$id]);

        return $this->render('accueil/souscategories.html.twig', [
            /* $categorie afficher les categories dans la navbar */
            'home' => $categories,
            'listesouscategories'=>$listesouscategories
            ]);
    }
    
    /**
     * @Route("/listeproduits/{id}", name="listeproduits")
     */
    public function Listeproduits(ProduitRepository $repo, $id, CategorieRepository $catrepo): Response
    {
        $produit = $repo->findBy(['souscategorie'=>$id]);

        return $this->render('accueil/listeproduits.html.twig', [
            'produit' => $produit,
            /* $categorie afficher les categories dans la navbar */
            'home' => $catrepo->findAll()
        ]);
    }


    /**
     * @Route("/details/{id}", name="details")
     */

    public function Details(CategorieRepository $cat, SousCategorieRepository $sousrepo, ProduitRepository $repo, $id): Response
    {
        $categories = $cat->findAll();
        $listesouscategories=$sousrepo->findBy(['categorie'=>$id]);
        $produit = $repo->findOneBy(['id'=>$id]);


        return $this->render('accueil/details.html.twig', [
            /* $categorie afficher les categories dans la navbar */
            'home' => $categories,
            'listesouscategories'=>$listesouscategories,
            'produit' => $produit,
        ]);
    }    

    /**
     * @Route("/profil", name="profil_client")
     */
    public function ProfilClient( CategorieRepository $cat): Response
    {
        $categories = $cat->findAll();


        return $this->render('profil/profil.html.twig', [
            'home' => $categories,

        ]);
    }


        /**
     * @Route("/recap_profil", name="recap_profil")
     */
    public function ProfilRecapClient( CategorieRepository $cat): Response
    {
        $categories = $cat->findAll();


        return $this->render('profil/recap_profil.html.twig', [
            'home' => $categories,

        ]);
    }
}
