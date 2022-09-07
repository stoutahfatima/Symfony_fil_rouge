<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Contenir;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\SousCategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContenirController extends AbstractController
{

    /**
     * @Route("/panier", name="panier")
     */

    public function index(SessionInterface $session, ProduitRepository $prod, CategorieRepository $cat)
    {
        $produit = $prod->findAll();
        $categories = $cat->findAll();
        $panier=$session->get('panier',[]);
        $panierAvecDonnees= [];
        foreach ($panier as $id  => $qte)
        {
            $panierAvecDonnees[]=[
                'produit'=> $prod->find($id), 
                'quantite'=> $qte
            ];
        }
        $total=0;
        foreach($panierAvecDonnees as $item){
            $totalItem =$item['produit']->getPrixht() * $item['quantite'];
            $total+= $totalItem;
        }
        return $this->render('contenir/panier.html.twig',[
            'home' => $categories,
            'items'=>$panierAvecDonnees,
            'total'=>$total,
            'produit'=>$produit,
            'panier'=>$panier
        ]);
    }


    /**
     * @Route("/panier/add/{id}", methods={"POST"}, name="panier_add")
     */
    public function panier_add($id, Request $request, SessionInterface $session, CategorieRepository $cat, SousCategorieRepository $sousrepo, ProduitRepository $repo)
    {
        $panier=$session->get('panier',[]);
        $quantite=$request->request->get('qte');
            if(!empty($panier[$id]))
            {

                $panier[$id] = $panier[$id] + (1* $quantite) ;
            } 
            else
            {
                $panier[$id] = 1 * $quantite;
            }
        
        $session->set('panier',$panier);

        $response = $this->forward('App\Controller\AccueilController::Details', [
            'cat'=> $cat,
            'sousrepo'=>$sousrepo,
            'repo'=>$repo,
            'id'=>$id
        ]);
    

    
        return $response;
    } 

    /**
     * @Route("/panier_delete/{id}", name="panier_delete")
     */

    public function delete($id, SessionInterface $session,Request $request)
    {
        $panier=$session->get('panier',[]);
        if(!empty($panier[$id]) ) 
        {
            
            unset($panier[$id]);
        }

        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier_update/{id}", name="panier_update")
     */

    public function update($id, SessionInterface $session,Request $request)
    {
        $panier=$session->get('panier',[]);
        $quantite=$request->request->get('qte');
        // if(!empty($panier[$id]))
        // {
            if($quantite>0){
            $panier[$id] = (1* $quantite) ;
            }
            else{
                unset($panier[$id]);
            }
        // } 
        $session->set('panier',$panier);

        return $this->redirectToRoute("panier");
    }

    /**
     * @Route("/panier_valider", name="panier_valider")
     */
    public function ValidationCommande(ClientRepository $client, CategorieRepository $cat, UserRepository $user, EntityManagerInterface $manager, SessionInterface $session, ProduitRepository $prod, Request $request): Response
    {

        $categories = $cat->findAll();
        $iduser=$user->find($this->getUser())->getClient()->getId();
        $profil=$client->findByUser($iduser);
        
        $commande = new Commande();
        $panier = $session->get('panier', []);

        $commande->setClient($profil);
        $commande->setDate(new \DateTime);
        $commande->setDateFact(new \DateTime);
        $commande->setAdresseLivraison($profil->getAdresse());
        $commande->setVilleLivraison($profil->getVille());
        $commande->setCpLivraison($profil->getCp());
        $commande->setAdresseFacturation($profil->getAdresse());
        $commande->setVilleFacturation($profil->getVille());
        $commande->setCpFacturation($profil->getCp());
        $commande->setEtat($profil->getCp());

        $manager->persist($commande);
        $manager->flush();
        $total=0;
        foreach ($panier as $key => $value) {
            $contenir = new Contenir();

            $produit = $prod->find($key);
            $quantite=$value;
            $prixht=$produit->getPrixht();
            $total+= $prixht * $quantite;
            $pttc=$total+($total * 0.05);
            $contenir->setCommande($commande);
            $contenir->setPrixVente($prixht);
            $contenir->setQtiteCommande($value);
            $contenir->setProduits($produit);
            // BESOIN D'ADDITIONNER TOUS LES PRIX DE VENTE DE CONTENIR PAS QUE LE DERNIER
            $manager->persist($contenir);
            $manager->flush();
        }
        $commande->setPrixTot($pttc);
        // dd($pttc);
        $manager->persist($commande);
        $manager->flush();

        $session->set('panier', []);

        return $this->render('contenir/panier_valider.html.twig', [
            'home' => $categories,
        ]);
    }

    /**
     * @Route("/informations/client", name="informations_client")
     */
    public function infos_client(ClientRepository $client, UserRepository $user, CategorieRepository $cat): Response
    {
        $categories = $cat->findAll();
        $iduser=$user->find($this->getUser())->getClient()->getId();
        $profil=$client->findByUser($iduser);


        return $this->render('profil/recap_profil.html.twig', [
            'profil' => $profil,
            'home' => $categories,
        ]);
    }


}
