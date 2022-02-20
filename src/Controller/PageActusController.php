<?php

namespace App\Controller;

use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageActusController extends AbstractController
{
    /**
     * @Route("/actus", name="page_actus")
     */
    public function index(PagesRepository $pr): Response
    {
        $currentPage = 'Actus';
        $pageData = $pr->findOneByTitle($currentPage);

        return $this->render('page_actus/index.html.twig', [
            'currentPage' => $currentPage,
            'page' => $pageData
        ]);
    }
}

