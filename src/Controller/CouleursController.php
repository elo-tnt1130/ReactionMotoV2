<?php

namespace App\Controller;

use App\Entity\Couleurs;
use App\Form\CouleursType;
use App\Repository\CouleursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/couleurs")
 * @IsGranted("ROLE_ADMIN")
 */
class CouleursController extends AbstractController
{
    /**
     * @Route("/", name="couleurs_index", methods={"GET"})
     */
    public function index(CouleursRepository $couleursRepository): Response
    {
        return $this->render('couleurs/index.html.twig', [
            'couleurs' => $couleursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="couleurs_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $couleur = new Couleurs();
        $form = $this->createForm(CouleursType::class, $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibCouleur = $couleur->getLibCouleur();
            $formatLibCouleur = trim(ucfirst(strtolower($formatLibCouleur)));
            $couleur->setLibCouleur($formatLibCouleur);

            $file = $form->get('img_color')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "paint-" . $_POST["couleurs"]["lib_couleur"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $couleur->setImgColor($uploadedfile);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($couleur);
            $entityManager->flush();

            $this->addFlash('success', 'La couleur a bien été ajoutée !');

            return $this->redirectToRoute('couleurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('couleurs/new.html.twig', [
            'couleur' => $couleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="couleurs_show", methods={"GET"})
     */
    public function show(Couleurs $couleur): Response
    {
        return $this->render('couleurs/show.html.twig', [
            'couleur' => $couleur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="couleurs_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Couleurs $couleur): Response
    {
        $form = $this->createForm(CouleursType::class, $couleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibCouleur = $couleur->getLibCouleur();
            $formatLibCouleur = trim(ucfirst(strtolower($formatLibCouleur)));
            $couleur->setLibCouleur($formatLibCouleur);

            $file = $form->get('img_color')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "paint-" . $_POST["couleurs"]["lib_couleur"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $couleur->setImgColor($uploadedfile);
            }


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'La couleur a bien été modifiée !');

            return $this->redirectToRoute('couleurs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('couleurs/edit.html.twig', [
            'couleur' => $couleur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="couleurs_delete", methods={"POST"})
     */
    public function delete(Request $request, Couleurs $couleur): Response
    {
        if ($this->isCsrfTokenValid('delete' . $couleur->getId(), $request->request->get('_token'))) {
            $file = $couleur->getImgColor();

            if ($file!=null && file_exists('img/' . $file)) {
                unlink('img/' . $file);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($couleur);
            $entityManager->flush();
            $this->addFlash('success', 'La couleur a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('couleurs_index', [], Response::HTTP_SEE_OTHER);
    }
}
