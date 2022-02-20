<?php

namespace App\Controller;

use App\Entity\Forfaits;
use App\Form\ForfaitsType;
use App\Repository\ForfaitsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/forfaits")
 * @IsGranted("ROLE_ADMIN")
 */
class ForfaitsController extends AbstractController
{
    /**
     * @Route("/", name="forfaits_index", methods={"GET"})
     */
    public function index(ForfaitsRepository $forfaitsRepository): Response
    {
        return $this->render('forfaits/index.html.twig', [
            'forfaits' => $forfaitsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="forfaits_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $forfait = new Forfaits();
        $form = $this->createForm(ForfaitsType::class, $forfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibelle = $forfait->getLibForfait();
            $formatLibelle = ucfirst(trim(mb_convert_case($formatLibelle, MB_CASE_LOWER)));
            $forfait->setLibForfait($formatLibelle);

            $formatPrix = $forfait->getPrixForfait();
            $formatPrix = trim(str_replace(",", ".", $formatPrix));
            $forfait->setPrixForfait($formatPrix);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($forfait);
            $entityManager->flush();

            $this->addFlash('success', 'Le forfait a bien été ajouté !');

            return $this->redirectToRoute('forfaits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forfaits/new.html.twig', [
            'forfait' => $forfait,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="forfaits_show", methods={"GET"})
     */
    public function show(Forfaits $forfait): Response
    {
        return $this->render('forfaits/show.html.twig', [
            'forfait' => $forfait,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="forfaits_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Forfaits $forfait): Response
    {
        $form = $this->createForm(ForfaitsType::class, $forfait);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le forfait a bien été modifié !');

            return $this->redirectToRoute('forfaits_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('forfaits/edit.html.twig', [
            'forfait' => $forfait,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="forfaits_delete", methods={"POST"})
     */
    public function delete(Request $request, Forfaits $forfait): Response
    {
        if ($this->isCsrfTokenValid('delete'.$forfait->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($forfait);
            $entityManager->flush();
        
            $this->addFlash('success', 'Le forfait a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('forfaits_index', [], Response::HTTP_SEE_OTHER);
    }
}
