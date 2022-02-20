<?php

namespace App\Controller;

use App\Repository\EtsRepository;
use App\Repository\ImagesRepository;
use App\Repository\MarquesRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MarquesRepository $mr, EtsRepository $er, PagesRepository $pr, ImagesRepository $ir): Response
    {
        $currentPage = 'Accueil';
        $pageData = $pr->findOneByTitle($currentPage); 
        $sections = $pr->findAll(); 

        $marques = $mr->findAll(); 
        $ets = $er->findAll();


        $service= $pageData->getServices();
        $carrousel = $ir->findByService($service);

        $images = $ir->findAll();
        

        return $this->render('home/index.html.twig', [
            'marques' => $marques,
            'ets' => $ets[0],
            'currentPage' => $currentPage,
            'page' => $pageData,
            'sections' => $sections,
            'carrousel' => $carrousel,
            'images' => $images,
        ]);
    }

}
