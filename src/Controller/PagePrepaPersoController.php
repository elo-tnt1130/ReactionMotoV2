<?php

namespace App\Controller;

use App\Repository\ImagesRepository;
use App\Repository\PagesRepository;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PagePrepaPersoController extends AbstractController
{
    /**
     * @Route("/prepa_perso", name="page_prepa_perso")
     */
    public function index(PagesRepository $pr, ImagesRepository $ir, ServicesRepository $sr): Response
    {
        $currentPage = 'Préparation et personnalisation';
        $pageData = $pr->findOneByTitle($currentPage);

        $prepa = $sr->findOneByName('Préparation');

        $carrouselPrepa = $ir->findByService($prepa);
        $imagesPrepa = $ir->findOneByService($prepa);

        $prepa = $sr->findOneByName('Personnalisation');

        $carrouselPerso = $ir->findByService($prepa);
        $imagesPerso = $ir->findOneByService($prepa);

        return $this->render('page_prepa_perso/index.html.twig', [
            'currentPage' => $currentPage,
            'page' => $pageData,
            'carrouselPrepa' => $carrouselPrepa,
            'carrouselPerso' => $carrouselPerso,
            'imagesPrepa' => $imagesPrepa,
            'imagesPerso' => $imagesPerso,
        ]);
    }
}
