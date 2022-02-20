<?php

namespace App\Controller;

use App\Entity\ThemesFAQ;
use App\Form\ThemesFAQType;
use App\Repository\ThemesFAQRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/themes_faq")
 * @IsGranted("ROLE_ADMIN")
 */
class ThemesFAQController extends AbstractController
{
    /**
     * @Route("/", name="themes_faq_index", methods={"GET"})
     */
    public function index(ThemesFAQRepository $themesFAQRepository): Response
    {
        return $this->render('themes_faq/index.html.twig', [
            'themes_faqs' => $themesFAQRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="themes_faq_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $themesFAQ = new ThemesFAQ();
        $form = $this->createForm(ThemesFAQType::class, $themesFAQ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatThemeQuestion = $themesFAQ->getThemeQuestion();
            $formatThemeQuestion = trim(ucfirst(mb_convert_case($formatThemeQuestion, MB_CASE_LOWER)));
            $themesFAQ->setThemeQuestion($formatThemeQuestion);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($themesFAQ);
            $entityManager->flush();

            $this->addFlash('success', 'La thématique a bien été ajoutée !');

            return $this->redirectToRoute('themes_faq_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('themes_faq/new.html.twig', [
            'themes_faq' => $themesFAQ,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="themes_faq_show", methods={"GET"})
     */
    public function show(ThemesFAQ $themesFAQ): Response
    {
        return $this->render('themes_faq/show.html.twig', [
            'themes_faq' => $themesFAQ,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="themes_faq_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ThemesFAQ $themesFAQ): Response
    {
        $form = $this->createForm(ThemesFAQType::class, $themesFAQ);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatThemeQuestion = $themesFAQ->getThemeQuestion();
            $formatThemeQuestion = trim(ucfirst(mb_convert_case($formatThemeQuestion, MB_CASE_LOWER)));
            $themesFAQ->setThemeQuestion($formatThemeQuestion);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La thématique a bien été modifiée !');

            return $this->redirectToRoute('themes_faq_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('themes_faq/edit.html.twig', [
            'themes_faq' => $themesFAQ,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="themes_faq_delete", methods={"POST"})
     */
    public function delete(Request $request, ThemesFAQ $themesFAQ): Response
    {
        if ($this->isCsrfTokenValid('delete'.$themesFAQ->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($themesFAQ);
            $entityManager->flush();
            $this->addFlash('success', 'La thématique a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('themes_faq_index', [], Response::HTTP_SEE_OTHER);
    }
}
