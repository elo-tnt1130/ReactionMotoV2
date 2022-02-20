<?php

namespace App\Controller;

use App\Repository\FAQRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageFAQController extends AbstractController
{
    /**
     * @Route("/faq", name="page_faq")
     */
    public function index(FAQRepository $faqr, PagesRepository $pr): Response
    {
        $currentPage = 'FAQ';
        $pageData = $pr->findOneByTitle($currentPage);

        $faqs = $faqr->findAll();
        return $this->render('page_faq/index.html.twig', [
            'faqs' => $faqs,
            'currentPage' => $currentPage,
            'page' => $pageData
        ]);
    }
}
