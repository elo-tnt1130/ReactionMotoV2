<?php

namespace App\Controller;

use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageMentionsLegalesController extends AbstractController
{
    /**
     * @Route("/mentions_legales", name="legacy")
     */
    public function index(PagesRepository $pr): Response
    {
        $currentPage = 'Mentions légales';
        $pageData = $pr->findOneByTitle($currentPage);

        return $this->render('page_mentions_legales/index.html.twig', [
            'currentPage' => $currentPage,
            'page' => $pageData
        ]);
    }
}
