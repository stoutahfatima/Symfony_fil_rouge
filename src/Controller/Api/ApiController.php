<?php



namespace App\Controller\Api;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController{
 

    /**
     * @Route("/api/v2/procucts", name="get_products", methods={"GET"})
     */
    public function getProducts(ProduitRepository $produitRepository){
        $produits = $produitRepository->findAll();

        return $this->json($produits, 200, ['Content-Type' => 'application/json'],  [ "groups" => "read:produit" ]);

    }


    /**
     * @Route("/apiv2/produits", name="create_product", methods={"POST"})
     */
    public function api2(Request $request, EntityManagerInterface $em, SousCategorieRepository $sousCategorieRepository): Response
    {
        $body = json_decode($request->getContent());

        $prix = $body->prix;
        $nom = $body->nom;

        $firstSubCategory = $sousCategorieRepository->findOneBy([], ['id' => 'ASC']);

        $p = new Produit();
        $p->setNom($nom);
        $p->setSouscategorie($firstSubCategory);
        $p->setPrixht($prix);
        $p->setDescription("");

        $em->persist($p);
        $em->flush();

        return $this->json(
            $p, 
            200, 
            [ ],
            [ "groups" => "read:produit" ]);
    }
    
}