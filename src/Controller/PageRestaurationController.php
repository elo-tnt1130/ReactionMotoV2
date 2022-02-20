<?php

namespace App\Controller;

use App\Repository\ImagesRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageRestaurationController extends AbstractController
{

    /**
     * @Route("/restauration", name="page_restauration")
     */
    public function index(PagesRepository $pr, ImagesRepository $ir): Response
    {

        $currentPage = 'Restauration';
        $pageData = $pr->findOneByTitle($currentPage);

        $service= $pageData->getServices();
        
        $carrousel = $ir->findByService($service);
        $images = $ir->findOneByService($service);
        
        return $this->render('page_restauration/index.html.twig', [
            'currentPage' => $currentPage,
            'page' => $pageData,
            'carrousel' => $carrousel,
            'images' => $images,
        ]);
    }
}
