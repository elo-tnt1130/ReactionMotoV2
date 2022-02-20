<?php

namespace App\Controller;

use App\Entity\Marques;
use App\Form\MarquesType;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use App\Repository\MarquesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/marques")
 * @IsGranted("ROLE_ADMIN")
 * /
 */ class MarquesController extends AbstractController
{
    /** 
     * @Route("/", name="marques_index", methods={"GET"})
     */
    public function index(MarquesRepository $marquesRepository): Response
    {
        return $this->render('marques/index.html.twig', [
            'marques' => $marquesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="marques_new", methods={"GET","POST"})
     * @param  mixed $request
     * @param  mixed $em
     * @return Response
     */
    public function new(Request $request, EntityManager $em): Response
    {
        $marque = new Marques();
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibMarque = $marque->getLibMarque();
            $formatLibMarque = ucfirst(trim(mb_convert_case($formatLibMarque, MB_CASE_LOWER)));
            $marque->setLibMarque($formatLibMarque);

            $file = $form->get('logo_marque')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "logo-" . $_POST["marques"]["lib_marque"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $marque->setLogoMarque($uploadedfile);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($marque);
            $em->flush();
            $this->addFlash("success", "La marque a bien été ajoutée.");

            return $this->redirectToRoute('marques_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marques/new.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="marques_show", methods={"GET"})
     */
    public function show(Marques $marque): Response
    {
        return $this->render('marques/show.html.twig', [
            'marque' => $marque,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="marques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Marques $marque): Response
    {
        $form = $this->createForm(MarquesType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibMarque = $marque->getLibMarque();
            $formatLibMarque = ucfirst(trim(mb_convert_case($formatLibMarque, MB_CASE_LOWER)));
            $marque->setLibMarque($formatLibMarque);

            $file = $form->get('logo_marque')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "logo-" . $_POST["marques"]["lib_marque"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $marque->setLogoMarque($uploadedfile);
            }

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'La marque a bien été modifiée !');

            return $this->redirectToRoute('marques_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('marques/edit.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="marques_delete", methods={"POST"})
     */
    public function delete(Request $request, Marques $marque): Response
    {
        if ($this->isCsrfTokenValid('delete' . $marque->getId(), $request->request->get('_token'))) {
            $file = $marque->getLogoMarque();

            if ($file!=null && file_exists('img/' . $file)) {
                unlink('img/' . $file);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($marque);
            $entityManager->flush();
            $this->addFlash('success', 'La marque a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('marques_index', [], Response::HTTP_SEE_OTHER);
    }
}
