<?php

namespace App\Controller\Api;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\SousCategorie;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\SousCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/", name="api_")
 * @api(name="api", description="api rest village green")
 */

class ApiController extends AbstractController
{


    /**
     *     CRUD:
     * Create: Insertion des données méthode: POST
     * Read: Lecture des données methode: GET
     * Update: Mise à jour des données methode: PUT
     * Delete: Suppression des données methode: DELETE
     * 
     * 
     */



    /**
     * @Route("produits", name="ProduitsListe", methods={"get"})
     * @api( name="ProduitsListe", description="liste de produits en get")
     * 
     */
    public function ProduitsListe(ProduitRepository $repo): Response
    {
        // BON

        return $this->json($repo->findAll(), 200, [], ['groups' => 'read:produit']);
    }

    /**
     * @Route("produits/{id}", name="produit",  methods={"get"})
     * @api( name="produit", description="detail du produit appelé par l'id")
     */
    public function Produit(Produit $produit): Response
    {
        // BON
        return $this->json($produit, 200, [], ['groups' => 'read:produit']);
    }

    /**
     * @Route("souscategorie", name="sousCategorieListe", methods={"get"})
     *  @api( name="liste des souscatégories", description="liste des souscatégorie en get")
     */
    public function SousCategorieListe(SousCategorieRepository $repo): Response
    {
        // BON
        return $this->json($repo->findAll(), 200, [], ['groups' => 'showcat']);
    }

    /**
     * @Route("souscategorie/{id}", name="souscategorie", methods={"get"})
     *  @api( name="SousCatégorie", description="souscatégorie chargé par l'id en get")
     */
    public function sousCategorie(SousCategorie $sousCategorie): Response
    {
        // TODO: ELYSE
        return $this->json($sousCategorie, 200, [], ['groups' => 'showcat']);
    }

    /**
     * @Route("produits", name="InsertProduit",  methods={"post"})
     *  @api( name="Insert produit", description="Insertion du produit")
     */
    public function InsertProduit(Request $request, EntityManagerInterface $manager,
                                  ValidatorInterface $validator, SousCategorieRepository $souscat): JsonResponse
    {
        // BON
        try {

            $data = json_decode($request->getContent());

            $error = $validator->validate($data);
            if (count($error) > 0) {
                return $this->json($error, 400
                );

            }

            $produit = new Produit();
            $souscategorie = $souscat->find($data->souscatid);
            $produit->setNom($data->nom);
            $produit->setDescription($data->description);
            $produit->setCaracteristiques($data->caracteristique);
            $produit->setPhoto($data->photo);
            $produit->setPrixht($data->price);
            $produit->setStock($data->stock);
            $produit->setSousCategorie($souscategorie);
            
            
            $manager->persist($produit);
            $manager->flush();

            return $this->json($produit, 201, [], ['groups' => "read:produit"]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }

    /**
     * @Route("souscategorie", name="InsertSousCategorie",  methods={"post"})
     *  @api( name="Insert souscategorie", description="Insertion de la souscategorie")
     */
    public function InsertSousCategorie(Request $request, EntityManagerInterface $manager,
                                    ValidatorInterface $validator, CategorieRepository $categorieRepository): JsonResponse
    {
        
        // BON
        try {

            $data = json_decode($request->getContent());

            $error = $validator->validate($data);
            if (count($error) > 0) {
                return $this->json($error, 400
                );
            }


            $souscategorie = new SousCategorie();
            if ($data->id_categorie) {
                // Je recupère une catégorie à partir de son identifiant(id)
                $categorie = $categorieRepository->find($data->id_categorie); // Categorie /// Sous catégorie

            } else {
                $categorie = null;
            }

            $souscategorie->setNom($data->nom);
            $souscategorie->setDescription($data->description);
            $souscategorie->setCategorie($categorie);
           // $souscategorie->setPhotos($data->photo);

           $manager->persist($souscategorie);
           $manager->flush();


            return $this->json($souscategorie, 201, [],  ['groups' => "showcat"]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }

    /**
     * @Route("souscategorie/{id}", name="UpdateSousCategorie",  methods={"put"})
     *  @api( name="update souscategorie", description="mise à jour de la souscategorie")
     */
    public function UpdateSousCategorie(Request $request, SousCategorie $sousCategorie, 
                                    ValidatorInterface $validator, EntityManagerInterface $manager,  CategorieRepository $categorieRepository): JsonResponse
    {
        // BON
        try {
            $data = json_decode($request->getContent());

            $error = $validator->validate($data);
            if (count($error) > 0) {
                return $this->json($error, 400
                );

            }
            if ($data->id_categorie) {
                $categorie = $categorieRepository->find($data->id_categorie);
            } else {
                $categorie = null;
            }

            $sousCategorie->setNom($data->nom);
            $sousCategorie->setCategorie($categorie);
            $sousCategorie->setDescription($data->description);
            //$sousCategorie->setPhotos($data->photo);

            $manager->flush();



            return $this->json($sousCategorie, 201, [], ['groups' => 'showcat']);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }

    /**
     * @Route("produits/{id}", name="UpdateProduit",  methods={"put"})
     *  @api( name="update produit", description="mise à jour d'un produit")
     */
    public function UpdateProduit(Request $request, Produit $produit, EntityManagerInterface $manager, 
                                  ValidatorInterface $validator): JsonResponse
    {
        // BON 
        try {
            $data = json_decode($request->getContent());

            $error = $validator->validate($data);
            if (count($error) > 0) {
                return $this->json($error, 400
                );

            }
            $produit->setNom($data->nom);
            $produit->setDescription($data->description);
            $produit->setCaracteristiques($data->caracteristique);
            $produit->setPhoto($data->photo);
            $produit->setPrixht($data->price);

            $manager->flush();
            

            return $this->json($produit, 201, [], ['groups' => "read:produit"]);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }

    /**
     * @Route("produits/{id}", name="DeleteProduit",  methods={"DELETE"})
     *  @api( name="delete produit", description="suppréssion du produit à parti de son identifiant")
     */
    public function DeleteProduit(EntityManagerInterface $manager,  Produit $produit): JsonResponse
    {
        try {

            if (file_exists('assets/src/' . $produit->getPhoto())) {
                unlink('assets/src/' . $produit->getPhoto());
            }
           
            $manager->remove($produit);
            $manager->flush();


            return $this->json(null, 201, [], []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }


    /**
     * @Route("souscategorie/{id}", name="DeleteSousCategorie",  methods={"DELETE"})
     *  @api( name="delete souscategorie", description="suppréssion du produit à partir de son identifiant")
     */
    public function DeleteSousCategorie(SousCategorie $souscategorie, EntityManagerInterface $manager): JsonResponse
    {
        try {
            if ($souscategorie->getPhotos()){

            if (file_exists('assets/src/' . $souscategorie->getPhotos())) {
                unlink('assets/src/' . $souscategorie->getPhotos());
            }
        }

            $manager->remove($souscategorie);
            $manager->flush();

            return $this->json(null, 201, [], []);
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }

    }

    /**
     * @Route("files/{table}/{id}", name="UploadFile",  methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     *  @api( name="upload du fichier ", description="upload de photo suivant la table")
     */
    public function UploadFile(Request $request, $table, $id, SousCategorieRepository $souscat, ProduitRepository $prod): JsonResponse
    {
        switch ($table) {

            case 'categorie';
                $photo = $souscat->find($id)->getPhotos();
                break;
            case 'produit';
                $photo = $prod->find($id)->getPhoto();

                break;
            default;
                $photo = $prod->find($id)->getPhoto();

        }
        try {
            $fichier = $request->files->get('photo');
            $aMimeTypes = array("image/gif", "image/jpeg", "image/jpg", "image/png", "image/x-png", "image/tiff");
            if (in_array($fichier->getClientmimeType(), $aMimeTypes)) {
                if ($fichier->move('assets/src/', $photo)) {
                    return $this->json(["id" => $id, "table" => $table, "photo" => $photo], 201, [], ['groups' => "show_products"]);
                }
            } else {
                return $this->json(["id" => $id, "table" => $table, "photo" => $photo, 'status' => 400,
                    'message' => "fichier non autorisé"], 400, []);
            }
        } catch (NotEncodableValueException $e) {
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ], 400
            );
        }
        return $this->json(['status' => 400,
            'message' => "fichier non autorisé ou non reçu"], 400, []);
    }


}
