<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use App\Repository\CategorieRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils, CategorieRepository $cat): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        $categories = $cat->findAll();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'home' => $categories,

        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        return $this->redirectToRoute('accueil');
    }


    /**
     * @Route("/profil/post", name="post_client")
     */
    public function AjoutClient(ClientRepository $client, CategorieRepository $cat, UserRepository $user, EntityManagerInterface $manager, Request $request)
    {  
        $categories = $cat->findAll();
        $iduser=$user->find($this->getUser())->getClient()->getId();
        $profil=$client->findByUser($iduser);
        
        
            // $profil = $client->findOneBy($user => $this->getUser());
        if ($request->getMethod() == 'POST') {
            $nom = $request->get('nom');
            $raison =$request->get('raison');
            $prenom = $request->get('prenom');
            $adresse = $request->get('adresse');
            $ville = $request->get('ville');
            $cp = $request->get('cp');
            $telephone = $request->get('tel');
            $genre=$request->get('genre');
            

            $profil->setNom($nom);
            $profil->setPrenom($prenom);
            $profil->setRaison($raison);
            $profil->setAdresse($adresse);
            $profil->setVille($ville);
            $profil->setCp($cp);
            $profil->setTel($telephone);
            $profil->setGenre($genre);
            
            $manager->persist($profil);
            $manager->flush();
        
        }
        return $this->render('profil/recap_profil.html.twig', [
            'home' => $categories,
        ]);
    }
}
