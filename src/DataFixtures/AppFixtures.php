<?php

namespace App\DataFixtures;

use App\Entity\Approvisionner;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Commercial;
use App\Entity\Contenir;
use App\Entity\Envoyer;
use App\Entity\Fournisseur;
use App\Entity\Livraison;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\SousCategorie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{



    public function load(ObjectManager $manager): void
    {

        $data0 = $this->loadFournisseur();
        foreach ($data0 as [$nom, $prenom, $adresse, $ville, $cp, $tel, $contact_nom, $contact_prenom, $raison]) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNom($nom)
                ->setPrenom($prenom)
                ->setAdresse($adresse)
                ->setVille($ville)
                ->setCp($cp)
                ->setTel($tel)
                ->setContactNom($contact_nom)
                ->setContactPrenom($contact_prenom)
                ->setRaison($raison);
            $manager->persist($fournisseur);
        }

        $manager->flush();


        $data1 = $this->loadCategories();
        foreach ($data1 as [$nom, $description, $photos]) {
            $categorie = new Categorie();
            $categorie->setNom($nom)
                ->setDescription($description)
                ->setPhotos($photos);

            $manager->persist($categorie);
        }


        $manager->flush();


        $data2 = $this->loadSousCategories();
        foreach ($data2 as [$categorie_id, $nom, $description, $photos]) {
            $souscategorie = new Souscategorie();
            $tmpCategorie = $manager->getRepository(Categorie::class)->find($categorie_id);
            $souscategorie->setCategorie($tmpCategorie)
                ->setNom($nom)
                ->setDescription($description)
                ->setPhotos($photos);

            $manager->persist($souscategorie);
        }


        $manager->flush();


        $data3 = $this->loadProduits();
        foreach ($data3 as [$souscategorie_id, $description, $nom, $photo, $stock, $prixht]) {
            $produit = new Produit();
            $tmpSousCategorie = $manager->getRepository(SousCategorie::class)->find($souscategorie_id);
            $produit->setSousCategorie($tmpSousCategorie)
                ->setDescription($description)
                ->setNom($nom)
                ->setPhoto($photo)
                ->setStock($stock)
                ->setPrixht($prixht);

            $manager->persist($produit);
        }

        $manager->flush();

        $data4 = $this->loadSuppliers();
        foreach ($data4 as [$prix_achat, $date_commande, $date_liv, $qtite, $fournisseur_id, $produits_id]) {
            $appovisionner = new Approvisionner();
            $appovisionner->setPrixachat($prix_achat)
                ->setDatecommande(new \Datetime($date_commande))
                ->setDateliv(new \Datetime($date_liv))
                ->setQtite($qtite);
            $tmpFournisseur = $manager->getRepository(Fournisseur::class)->find($fournisseur_id);
            $appovisionner->setFournisseurs($tmpFournisseur);
            $tmpProduit = $manager->getRepository(Produit::class)->find($produits_id);
            $appovisionner->setProduits($tmpProduit);

            $manager->persist($appovisionner);
        }
        $manager->flush();


        $data5 = $this->loadClients();
        foreach ($data5 as [$nom, $prenom, $raison, $adresse, $ville, $cp, $tel, $genre]) {
            $client = new Client();
            $client->setNom($nom)
                ->setPrenom($prenom)
                ->setraison($raison)
                ->setAdresse($adresse)
                ->setVille($ville)
                ->setCp($cp)
                ->setTel($tel)
                ->setGenre($genre);

            $manager->persist($client);
        }


        $manager->flush();


        $data6 = $this->loadLivraison();
        foreach ($data6 as [$num_bon, $date, $etat]) {
            $livraison = new Livraison();
            $livraison->setNumbon($num_bon)
                ->setDate(new \Datetime($date))
                ->setEtat($etat);
            $manager->persist($livraison);
        }


        $manager->flush();


        $data7 = $this->loadCommandes();
        foreach ($data7 as [$client_id, $livraison_id, $date, $reduc, $prix_tot, $date_reglem, $date_fact, $etat, $adresse_livraison, $ville_livraison, $cp_livraison, $adresse_facturation, $ville_facturation, $cp_facturation]) {
            $commande = new Commande();
            $tmpClient = $manager->getRepository(Client::class)->find($client_id);
            $commande->setClient($tmpClient);
            $tmpLivraison = $manager->getRepository(Livraison::class)->find($livraison_id);
            $commande->setLivraison($tmpLivraison)
                ->setDate(new \Datetime($date))
                ->setReduc($reduc)
                ->setPrixtot($prix_tot)
                ->setDatereglem(new \Datetime($date_reglem))
                ->setDatefact(new \Datetime($date_fact))
                ->setEtat($etat)
                ->setAdresselivraison($adresse_livraison)
                ->setVillelivraison($ville_livraison)
                ->setCplivraison($cp_livraison)
                ->setAdressefacturation($adresse_facturation)
                ->setVillefacturation($ville_facturation)
                ->setCpfacturation($cp_facturation);


            $manager->persist($commande);
        }

        $manager->flush();


        $data8 = $this->loadCommercials();
        foreach ($data8 as [$client_id, $nom, $prenom, $tel]) {
            $commercial = new Commercial();
            $tmpClient = $manager->getRepository(Client::class)->find($client_id);
            $commercial->setClient($tmpClient)
                ->setNom($nom)
                ->setPrenom($prenom)
                ->setTel($tel);


            $manager->persist($commercial);
        }


        $manager->flush();


       
        $data10 = $this->loadSenders();
        foreach ($data10 as [$livraison_id, $produits_id]) {
            $envoyer = new Envoyer();
            $tmpLivraison = $manager->getRepository(Livraison::class)->find($livraison_id);
            $envoyer->setLivraison($tmpLivraison);
            $tmpProduit = $manager->getRepository(Produit::class)->find($produits_id);
            $envoyer->setProduits($tmpProduit);

            $manager->persist($envoyer);
        }


        $manager->flush();

        

        $data11 = $this->loadUsers();
        foreach ($data11 as [$email, $roles, $password, $is_verified, $client_id]) {
            $user = new User();
            $user->setEmail($email)
                ->setRoles($roles)
                ->setPassword($password)
                ->setIsverified($is_verified);
            $tmpClient = $manager->getRepository(Client::class)->find($client_id);
            $user->setClient($tmpClient);


            $manager->persist($user);
        }


        $manager->flush();


        $data9 = $this->loadContenir();
        foreach ($data9 as [$produits_id, $commande_id, $qtite_commande, $prix_vente]) {
            $contenir = new Contenir();
            $tmpProduit = $manager->getRepository(Produit::class)->find($produits_id);
            $contenir->setProduits($tmpProduit);
            $tmpCommande = $manager->getRepository(Commande::class)->find($commande_id);
            $contenir->setCommande($tmpCommande)
                ->setQtitecommande($qtite_commande)
                ->setPrixvente($prix_vente);

            $manager->persist($contenir);
        }


        $manager->flush();


       
       

    }



    private function loadSuppliers()
    {
        return array(
            array(27000, '2022-05-16', '2022-05-16', 200, 1, 1),
        );
    }

    private function loadClients()
    {
        return array(
            // [$nom, $prenom, $raison, $adresse, $ville, $cp, $tel, $genre]
            array('', '', 'GUITARLAND', '145 Rue des poins levés', 'Amiens', '80000', '0322457815', ''), // 1
            array('', '', 'WOODSTOCK', '105 bd vaucluse', 'Beauvais', '60000', '0345781236', ''),// 2
            array('', '', 'LOCAVIOLON', '10 allée de l\'ecce tarre', 'Reims', '51100', '0163985247', ''),// 3
            array('user', 'Jean', '', '18 Quai des Orfèvres', 'Paris', '75001', '0582937145', 'Mme'),// 4
            array('admin', 'admin', NULL, NULL, NULL, NULL, NULL, 'M')// 5

        );
    }

    private function loadCommandes()
    {
        //[$client_id, $livraison_id, $date, $reduc, $prix_tot, $date_reglem, $date_fact, $etat, $adresse_livraison, $ville_livraison, $cp_livraison, $adresse_facturation, $ville_facturation, $cp_facturation]
        return array(
            array(4, 1, '2022-05-20', NULL, '2867.55', NULL, '2022-05-20', '75001', '18 Quai des Orfèvres', 'Paris', '75001', '18 Quai des Orfèvres', 'Paris', '75001'),

        ); // id : 1
    }

    private function loadCommercials()
    {
        return array(
            array(1, 'BERNARD', 'Thomas', '0345725145'),
            array(2, 'MAGNOLIA', 'Orphée', '0645781236'),
            array(3, 'WATIN', 'Sylvain', '0322568974')
        );
    }

    private function loadContenir()
    {
        return array(
            // [$produits_id, $commande_id, $qtite_commande, $prix_vente]
            array(1, 1, 2, '656.00'),
            array(2, 1, 4, '98.00'),
            array(3, 1, 1, '429.00'),
            array(5, 1, 1, '598.00')
        );
    }

    private function loadSenders()
    {
        return array(
            array('1', '1'),

        );
    }

    private function loadFournisseur()
    {
        return array(
            array('Armozo', 'Galotino', '06 rue laymes', 'Paris', '75003', '0173481178', 'Vermesh', 'Salome', 'ARMOZO'),
            array('Bolies', 'Paul', '63 bd marguerite levant', 'Paris', '75009', '0785898682', 'DUPONT', 'François', 'Aarpège')
        );
    }


    private function loadLivraison()
    {
        return array(
            array('1', '2022-05-16', 'en préparation'),
        );
    }

    private function loadProduits()
    {
        // [$souscategorie_id, $description, $nom, $photo, $stock, $prixht
        return array(
            array(1, 'Yamaha c-40 Guitare Classique', 'Guitare C-40', 'C-40.jpeg', 25, '139'),
            array(17, 'Startone SSL-45 Bb-Tenor Trombone', 'Trombone SSL-45', 'SSL-45.jpg', 17, '138'),
            array(15, 'Yamaha P-45 Piano numérique', 'Piano P-45', 'P-45.jpg', 10, '429'),
            array(13, 'Behringer Xenyx X1204 USB Table de mixage', 'Table mixage analogique X1204', 'X1204.jpg', 5, '179'),
            array(7, 'Batterie Acoustique Millenium Focus 22 Drum Set Black', 'Millenium Focus 22 Drum Set Black', 'Batterie22.jpeg', 2, '258'),
            array(10, 'Thomann E-Guitar Case ABS', 'Etui rigide Thomann E-Guitar Case ABS', 'Etuiguitarelec.jpg', 25, '66'),
            array(9, 'Thomann Stage Piano Bag', 'Housse Thomann Stage Piano Bag', 'houssepiano.jpg', 25, '45'),
            array(18, 'HK Audio Sonar 115 Sub D', 'Sono caisson HK Audio Sonar 115 Sub D', 'Sonocaissonbasse.jpg', 13, '656')
        );
    }

    private function loadCategories()
    {
        return array(
            array('Batterie', 'Viens jouer de la baguette!', 'CATEGORIES Batterie.png'),
            array('Cases', 'Des caissons à n\'en plus finir', 'CATEGORIES Cases.png'),
            array('Cordes', 'Viens gratter de la corde', 'CATEGORIES Cordes.png'),
            array('Studio', 'Parfait pour la futur nouvelle star', 'CATEGORIES Studio.png'),
            array('Claviers', 'Joue ton meilleur \"Harry potter thème\"', 'CATEGORIES Claviers.png'),
            array('Vents', 'Souffle aussi fort que le loup', 'CATEGORIES Vents.png'),
            array('Sono', 'David ? c\'est toi ?', 'CATEGORIES Sono.png'),
            array('Cables', 'Pour en finir avec le pétage de cables !', 'CATEGORIES Cable.png')
        );
    }

    private function loadSousCategories()
    {
        return array(
            array(3, 'Guitares Electriques', '', 'Guitare_electrique.png'),
            array(3, 'Guitares Acoustiques', '', 'Guitare_acoustique.png'),
            array(3, 'Guitares Electro Acoustiques', '', 'Guitare_electro_acoustique.png'),
            array(3, 'Basses Electriques', '', 'Basse_electrique.png'),
            array(3, 'Basses Acoustiques', '', 'Basse_acoustique.png'),
            array(3, 'Ukulélés', '', 'Ukulele.png'),
            array(1, 'Batteries Acoustiques', '', 'Batterie_Acoustique.png'),
            array(1, 'Bateries Electroniques', '', 'Batterie_Electronique.png'),
            array(2, 'Housses', '', 'Housses.png'),
            array(2, 'Flight Cases', '', 'Rigide.png'),
            array(2, 'Etuis Rigide', '', 'Etuis_rigide.png'),
            array(4, 'Micro     ', 'Prise de son', 'Micro.png'),
            array(4, 'Mixage', 'Table de mixage', 'Mixage.png'),
            array(5, 'Pianos à queues', '', 'Piano_a_queue.png'),
            array(5, 'Pianos synthétiseurs', '', 'Piano_synthetiseur.png'),
            array(6, 'Saxophones', '', 'Saxo.png'),
            array(6, 'Trombones', '', 'Trombonne.png'),
            array(7, 'Caissons de basses', '', 'Caisson_basse.png'),
            array(7, 'Ampli à guitare', '', 'Ampli.png'),
            array(8, 'Câbles pour instruments', NULL, 'Cable_instru.png'),
            array(8, 'Câbles pour microphones', NULL, 'Cable_micro.png'),
            array(8, 'Câbles MIDI', NULL, 'Cable_mdi.png')
        );
    }

    private function loadUsers()
    {
        return array(
            array('user@user', [], '$2y$13$aCy/6xmFVHV9EKQ4Q364Ze67amSvMvqLKqzY66H5h2zXEZaMxUK.W', 1, 1),
            array('admin@admin', ["ROLE_ADMIN"], '$2y$13$q2ccX5xB/XWFJR9yApur0uCDziJTA12UIUwRuFD9AQLahPJFcEiMW', 0, 2)
        );
    }
}
