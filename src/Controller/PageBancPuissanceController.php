<?php

namespace App\Controller;

use App\Repository\ForfaitsRepository;
use App\Repository\ImagesRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageBancPuissanceController extends AbstractController
{
    /**
     * @Route("/banc_puissance", name="page_banc_puissance")
     */
    public function index(PagesRepository $pr, ForfaitsRepository $fr, ImagesRepository $ir): Response
    {
        $currentPage = 'Banc de puissance';
        $pageData = $pr->findOneByTitle($currentPage);
    
        $service = $pageData->getServices();
        $forfaitsData = $fr->findByServices($service);

        $carrousel = $ir->findByService($service);
        $images = $ir->findOneByService($service);
    
        return $this->render('page_banc_puissance/index.html.twig', [
            'currentPage' => $currentPage,
            'page' => $pageData, 
            'forfaits' => $forfaitsData,
            'carrousel' => $carrousel,
            'images' => $images,
        ]);
    }
}
