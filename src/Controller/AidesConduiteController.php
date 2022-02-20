<?php

namespace App\Controller;

use App\Entity\AidesConduite;
use App\Form\AidesConduiteType;
use App\Repository\AidesConduiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/aides_conduite")
 * @IsGranted("ROLE_ADMIN")
 */
class AidesConduiteController extends AbstractController
{
    /**
     * @Route("/", name="aides_conduite_index", methods={"GET"})
     */
    public function index(AidesConduiteRepository $aidesConduiteRepository): Response
    {
        return $this->render('aides_conduite/index.html.twig', [
            'aides_conduites' => $aidesConduiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="aides_conduite_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $aidesConduite = new AidesConduite();
        $form = $this->createForm(AidesConduiteType::class, $aidesConduite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $formatLibAideConduite = $aidesConduite->getLibAideConduite();
            $formatLibAideConduite = str_replace(".", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("-", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("_", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("/", " ", ucfirst(htmlentities(htmlspecialchars($formatLibAideConduite))));
            $aidesConduite->setLibAideConduite($formatLibAideConduite);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($aidesConduite);
            $entityManager->flush();
            $this->addFlash('success', 'L\aide à la conduite a bien été ajoutée !');
            return $this->redirectToRoute('aides_conduite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aides_conduite/new.html.twig', [
            'aides_conduite' => $aidesConduite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="aides_conduite_show", methods={"GET"})
     */
    public function show(AidesConduite $aidesConduite): Response
    {
        return $this->render('aides_conduite/show.html.twig', [
            'aides_conduite' => $aidesConduite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="aides_conduite_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, AidesConduite $aidesConduite): Response
    {
        $form = $this->createForm(AidesConduiteType::class, $aidesConduite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibAideConduite = $aidesConduite->getLibAideConduite();
            $formatLibAideConduite = str_replace(".", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("-", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("_", " ", ucfirst($formatLibAideConduite));
            $formatLibAideConduite = str_replace("/", " ", ucfirst(htmlentities(htmlspecialchars($formatLibAideConduite))));
            $aidesConduite->setLibAideConduite($formatLibAideConduite);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'aide à la conduite a bien été modifiée !');

            return $this->redirectToRoute('aides_conduite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('aides_conduite/edit.html.twig', [
            'aides_conduite' => $aidesConduite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="aides_conduite_delete", methods={"POST"})
     */
    public function delete(Request $request, AidesConduite $aidesConduite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$aidesConduite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($aidesConduite);
            $entityManager->flush();
            $this->addFlash('success', 'L\'aide à la conduite a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('aides_conduite_index', [], Response::HTTP_SEE_OTHER);
    }
}
