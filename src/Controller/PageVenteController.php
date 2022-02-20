<?php

namespace App\Controller;

use App\Repository\MarquesRepository;
use App\Repository\ModelesRepository;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vente")
 */
class PageVenteController extends AbstractController
{
    /**
     * @Route("/", name="page_vente")
     */
    public function vente(PagesRepository $pr, MarquesRepository $mr): Response
    {

        $currentPage = 'Vente de motos';
        $pageData = $pr->findOneByTitle($currentPage);

        $marques = $mr->findAll();


        return $this->render('page_vente/marques.html.twig', [
            'page' => $pageData,
            'currentPage' => $currentPage,
            'marques' => $marques,
        ]);
    }

    /**
     * @Route("/benelli", name="page_benelli")
     */
    public function benelli(PagesRepository $pr, MarquesRepository $mr, ModelesRepository $mor): Response
    {

        $currentPage = 'Benelli';
        $pageData = $pr->findOneByTitle($currentPage);
        $marque = $mr->findOneByMarque($currentPage);
        $id=$marque->getId();
        $modeles = $mor->findByMarqueId($id);

        return $this->render('page_vente/benelli.html.twig', [
            'page' => $pageData,
            'currentPage' => $currentPage,
            'marque'=>$marque, 
            'modeles'=>$modeles
        ]);
    }

    /**
     * @Route("/brixton", name="page_brixton")
     */
    public function brixton(PagesRepository $pr, MarquesRepository $mr, ModelesRepository $mor): Response
    {

        $currentPage = 'Brixton';
        $pageData = $pr->findOneByTitle($currentPage);
        $marque = $mr->findOneByMarque($currentPage);
        $id=$marque->getId();
        $modeles = $mor->findByMarqueId($id);

        return $this->render('page_vente/brixton.html.twig', [
            'page' => $pageData,
            'currentPage' => $currentPage,
            'marque'=>$marque, 
            'modeles'=>$modeles
        ]);
    }

    /**
     * @Route("/occasions", name="page_occasions")
     */
    public function occasions(PagesRepository $pr, MarquesRepository $mr, ModelesRepository $mor): Response
    {

        $currentPage = 'Occasions';
        $pageData = $pr->findOneByTitle($currentPage);
        $marque = $mr->findOneByMarque($currentPage);
        $id=$marque->getId();
        $modeles = $mor->findByMarqueId($id);

        return $this->render('page_vente/occasions.html.twig', [
            'page' => $pageData,
            'currentPage' => $currentPage,
            'marque'=>$marque, 
            'modeles'=>$modeles
        ]);
    }

    /**
     * @Route("/showMoto/{id}", name="show_moto", requirements={"id"="\d+"} )
     */
    public function modele(ModelesRepository $modr, $id): Response
    {
        $currentPage = 'Modele';
        $modele = $modr->find($id);

        return $this->render('page_vente/show.html.twig', [
            'currentPage' => $currentPage,
            'modele' => $modele, 
        ]);
    }
}