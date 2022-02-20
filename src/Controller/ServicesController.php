<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/services")
 * @IsGranted("ROLE_ADMIN")
 */
class ServicesController extends AbstractController
{
    /**
     * @Route("/", name="services_index", methods={"GET"})
     */
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="services_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibService = $service->getLibService();
            $formatLibService = trim(ucfirst(mb_convert_case($formatLibService, MB_CASE_LOWER)));
            $service->setLibService($formatLibService);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($service);
            $entityManager->flush();

            $this->addFlash('success', 'Le service a bien été ajouté !');

            return $this->redirectToRoute('services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="services_show", methods={"GET"})
     */
    public function show(Services $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="services_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Services $service): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibService = $service->getLibService();
            $formatLibService = trim(ucfirst(mb_convert_case($formatLibService, MB_CASE_LOWER)));
            $service->setLibService($formatLibService);

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le service a bien été modifié !');

            return $this->redirectToRoute('services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="services_delete", methods={"POST"})
     */
    public function delete(Request $request, Services $service): Response
    {
        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($service);
            $entityManager->flush();
            $this->addFlash('success', 'Le service a bien été supprimé !');
        } else {
            $this->addFlash("danger", "Une erreur est survenue !");
        }

        return $this->redirectToRoute('services_index', [], Response::HTTP_SEE_OTHER);
    }
}
