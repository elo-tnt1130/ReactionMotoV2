<?php

namespace App\Controller;

use App\Entity\Images;
use App\Form\ImagesType;
use App\Repository\ImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/images")
 * @IsGranted("ROLE_ADMIN")
 */
class ImagesController extends AbstractController
{
    /**
     * @Route("/", name="images_index", methods={"GET"})
     */
    public function index(ImagesRepository $imagesRepository): Response
    {
        return $this->render('images/index.html.twig', [
            'images' => $imagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="images_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $image = new Images();
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $img = $form->get('lib_img')->getData();
            if (isset($_FILES['images']['name']['lib_img'])) {
                $uploadedfileImg = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $service = $_POST["images"]["services"];
                switch ($service) {
                    case 1:
                        $uploadedfileImg = "page-restauration";
                        break;
                    case 2:
                        $uploadedfileImg = "page-entretien";
                        break;
                    case 3:
                        $uploadedfileImg = "page-bancpuissance";
                        break;
                    case 4:
                        $uploadedfileImg = "page-preparation";
                        break;
                    case 5:
                        $uploadedfileImg = "page-personnalisation";
                        break;
                    case 9:
                        $uploadedfileImg = "page-accueil";
                        break;
                }

                $uploadedfileImg = str_replace(" ", "_", $uploadedfileImg);
                $uploadedfileImg .= "_" . uniqid() . "." . $img->guessExtension();
                $img->move('img/', $uploadedfileImg);
                $image->setLibImg($uploadedfileImg);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();
            $this->addFlash('success', 'L\'image a bien été ajoutée !');

            return $this->redirectToRoute('images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('images/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="images_show", methods={"GET"})
     */
    public function show(Images $image): Response
    {
        return $this->render('images/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="images_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Images $image): Response
    {
        $form = $this->createForm(ImagesType::class, $image);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $img = $form->get('lib_img')->getData();

            if (isset($_FILES['images']['name']['lib_img']) || !$image->getLibImg()) {
                $uploadedfileImg = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $service = $_POST["images"]["services"];
                switch ($service) {
                    case 1:
                        $uploadedfileImg = "page-restauration";
                        break;
                    case 2:
                        $uploadedfileImg = "page-entretien";
                        break;
                    case 3:
                        $uploadedfileImg = "page-bancpuissance";
                        break;
                    case 4:
                        $uploadedfileImg = "page-preparation";
                        break;
                    case 5:
                        $uploadedfileImg = "page-personnalisation";
                        break;
                    case 9:
                        $uploadedfileImg = "page-accueil";
                        break;
                }

                $uploadedfileImg = str_replace(" ", "_", $uploadedfileImg);
                $uploadedfileImg .= "_" . uniqid() . "." . $img->guessExtension();
                $img->move('img/', $uploadedfileImg);
                $image->setLibImg($uploadedfileImg);
            }


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'image a bien été modifiée !');

            return $this->redirectToRoute('images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('images/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="images_delete", methods={"POST"})
     */
    public function delete(Request $request, Images $image): Response
    {
        if ($this->isCsrfTokenValid('delete' . $image->getId(), $request->request->get('_token'))) {

            $file = $image->getLibImg();
            if ($file!=null && file_exists('img/' . $file)) {
                unlink('img/' . $file);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
            $this->addFlash('success', 'L\'image a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('images_index', [], Response::HTTP_SEE_OTHER);
    }
}
