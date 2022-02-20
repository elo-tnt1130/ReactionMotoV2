<?php

namespace App\Controller;

use App\Entity\Pages;
use App\Form\PagesType;
use App\Repository\PagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/pages")
 * @IsGranted("ROLE_ADMIN")
 */
class PagesController extends AbstractController
{
    /**
     * @Route("/", name="pages_index", methods={"GET"})
     */
    public function index(PagesRepository $pagesRepository): Response
    {
        return $this->render('pages/index.html.twig', [
            'pages' => $pagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $page = new Pages();
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($page);
            $entityManager->flush();

            $this->addFlash('success', 'Le contenu de la page a bien été ajouté !');

            return $this->redirectToRoute('pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/new.html.twig', [
            'page' => $page,
            'form' => $form
        ]);
    }

    /**
     * @Route("/{id}", name="pages_show", methods={"GET"})
     */
    public function show(Pages $page): Response
    {
        return $this->render('pages/show.html.twig', [
            'page' => $page,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pages $page): Response
    {
        $form = $this->createForm(PagesType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le contenu de la page a bien été modifié !');

            return $this->redirectToRoute('pages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/edit.html.twig', [
            'page' => $page,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="pages_delete", methods={"POST"})
     */
    public function delete(Request $request, Pages $page): Response
    {
        if ($this->isCsrfTokenValid('delete'.$page->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($page);
            $entityManager->flush();

            $this->addFlash('success', 'Le contenu de la page a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('pages_index', [], Response::HTTP_SEE_OTHER);
    }
}
