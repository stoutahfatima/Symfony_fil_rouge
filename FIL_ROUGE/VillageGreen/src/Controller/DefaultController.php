<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

     /**
     * @Route("/react/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index(CategorieRepository $cat)
    {
        return $this->render('default/index.html.twig', [
             'home' => $cat->findAll()
        ]);
    }
}