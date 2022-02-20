<?php

namespace App\Controller;

use App\Entity\Permis;
use App\Form\PermisType;
use App\Repository\PermisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/permis")
 * @IsGranted("ROLE_ADMIN")
 */
class PermisController extends AbstractController
{
    /**
     * @Route("/", name="permis_index", methods={"GET"})
     */
    public function index(PermisRepository $permisRepository): Response
    {
        return $this->render('permis/index.html.twig', [
            'permis' => $permisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="permis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $permis = new Permis();
        $form = $this->createForm(PermisType::class, $permis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('symbole_permis')->getData();
            
            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "symbole-permis" . $_POST["permis"]["lib_permis"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $permis->setSymbolePermis($uploadedfile);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($permis);
            $entityManager->flush();

            $this->addFlash('success', 'Le permis a bien été ajouté !');

            return $this->redirectToRoute('permis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('permis/new.html.twig', [
            'permis' => $permis,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="permis_show", methods={"GET"})
     */
    public function show(Permis $permis): Response
    {
        return $this->render('permis/show.html.twig', [
            'permis' => $permis,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="permis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Permis $permis): Response
    {
        $form = $this->createForm(PermisType::class, $permis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->get('symbole_permis')->getData();
            
            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "symbole-permis" . $_POST["permis"]["lib_permis"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $permis->setSymbolePermis($uploadedfile);
            }
            
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le permis a bien été modifié !');

            return $this->redirectToRoute('permis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('permis/edit.html.twig', [
            'permis' => $permis,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="permis_delete", methods={"POST"})
     */
    public function delete(Request $request, Permis $permis): Response
    {
        if ($this->isCsrfTokenValid('delete'.$permis->getId(), $request->request->get('_token'))) {
            $file = $permis->getSymbolePermis();

            if ($file!=null && file_exists('img/' . $file)) {
                unlink('img/' . $file);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($permis);
            $entityManager->flush();
            $this->addFlash('success', 'Le permis a bien été supprimé !');
        }else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('permis_index', [], Response::HTTP_SEE_OTHER);
    }
}
