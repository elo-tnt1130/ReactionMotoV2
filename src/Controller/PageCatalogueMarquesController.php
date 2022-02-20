<?php

namespace App\Controller;

use App\Repository\MarquesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageCatalogueMarquesController extends AbstractController
{
    /**
     * @Route("/page/catalogue_marques", name="page_catalogue_marques")
     */
    public function index(MarquesRepository $mr): Response
    {
        $marques = $mr->findAll();
        return $this->render('page_catalogue_marques/index.html.twig', [
            'marques' => $marques
        ]);
    }
}
