<?php

namespace App\Controller;

use App\Entity\Moteurs;
use App\Form\MoteursType;
use App\Repository\MoteursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/moteurs")
 * @IsGranted("ROLE_ADMIN")
 */
class MoteursController extends AbstractController
{
    /**
     * @Route("/", name="moteurs_index", methods={"GET"})
     */
    public function index(MoteursRepository $moteursRepository): Response
    {
        return $this->render('moteurs/index.html.twig', [
            'moteurs' => $moteursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="moteurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $moteur = new Moteurs();
        $form = $this->createForm(MoteursType::class, $moteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatCylindree = $moteur->getCylindree();
            $formatCylindree = trim($formatCylindree);
            $moteur->setCylindree($formatCylindree);
            
            $formatPuissance = $moteur->getPuissanceCh();
            $formatPuissance = trim(str_replace(",", ".", $formatPuissance));
            $moteur->setPuissanceCh($formatPuissance);
            
            $formatCouple = $moteur->getCoupleNm();
            $formatCouple = ($formatCouple)? trim(str_replace(",", ".", $formatCouple)):"0";
            $moteur->setCoupleNm($formatCouple);

            $formatRegimePuissance = $moteur->getRegimeMoteurPuissance();
            $formatRegimePuissance = trim($formatRegimePuissance);
            $moteur->setRegimeMoteurPuissance($formatRegimePuissance);

            $formatRegimeCouple = $moteur->getRegimeMoteurCouple();
            $formatRegimeCouple = trim($formatRegimeCouple);
            $moteur->setRegimeMoteurCouple($formatRegimeCouple);
            // dd($moteur);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($moteur);
            $entityManager->flush();

            return $this->redirectToRoute('moteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('moteurs/new.html.twig', [
            'moteur' => $moteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="moteurs_show", methods={"GET"})
     */
    public function show(Moteurs $moteur): Response
    {
        return $this->render('moteurs/show.html.twig', [
            'moteur' => $moteur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="moteurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Moteurs $moteur): Response
    {
        $form = $this->createForm(MoteursType::class, $moteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatCylindree = $moteur->getCylindree();
            $formatCylindree = trim($formatCylindree);
            $moteur->setCylindree($formatCylindree);
            
            $formatPuissance = $moteur->getPuissanceCh();
            $formatPuissance = trim(str_replace(",", ".", $formatPuissance));
            $moteur->setPuissanceCh($formatPuissance);
            
            $formatCouple = $moteur->getCoupleNm();
            $formatCouple = trim(str_replace(",", ".", $formatCouple));
            $moteur->setCoupleNm($formatCouple);

            $formatRegimePuissance = $moteur->getRegimeMoteurPuissance();
            $formatRegimePuissance = trim($formatRegimePuissance);
            $moteur->setRegimeMoteurPuissance($formatRegimePuissance);

            $formatRegimeCouple = $moteur->getRegimeMoteurCouple();
            $formatRegimeCouple = trim($formatRegimeCouple);
            $moteur->setRegimeMoteurCouple($formatRegimeCouple);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('moteurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('moteurs/edit.html.twig', [
            'moteur' => $moteur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="moteurs_delete", methods={"POST"})
     */
    public function delete(Request $request, Moteurs $moteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('moteurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
