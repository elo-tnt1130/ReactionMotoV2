<?php

namespace App\Controller;

use App\Entity\Ets;
use App\Form\EtsType;
use App\Repository\EtsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/ets")
 * @IsGranted("ROLE_ADMIN")
 */
class EtsController extends AbstractController
{
    /**
     * @Route("/", name="ets_index", methods={"GET"})
     */
    public function index(EtsRepository $etsRepository): Response
    {
        return $this->render('ets/index.html.twig', [
            'ets' => $etsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ets = new Ets();
        $form = $this->createForm(EtsType::class, $ets);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ets);
            $entityManager->flush();

            $this->addFlash('success', 'L\'entreprise a bien été ajoutée !');

            return $this->redirectToRoute('ets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ets/new.html.twig', [
            'et' => $ets,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ets_show", methods={"GET"})
     */
    public function show(Ets $ets): Response
    {
        return $this->render('ets/show.html.twig', [
            'et' => $ets,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ets $ets): Response
    {
        $form = $this->createForm(EtsType::class, $ets);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            //* texte d'accueil : doesn't work

            $formatWelcomeText = $ets->getTexteAccueil();
            function formatText($separator, $format)
            {
                $explodedFormatWelcomeText = explode($separator, $format);

                foreach ($explodedFormatWelcomeText as $explodedSentence) {
                    ucfirst(strtolower($explodedSentence));
                    // dd($explodedSentence);
                }

                $format = implode($separator, $explodedFormatWelcomeText);

                return $format;
            }

            formatText('.', $formatWelcomeText);
            // formatText("!", $formatWelcomeText);
            // formatText('?', $formatWelcomeText);

            $formatWelcomeText = htmlentities(htmlspecialchars($formatWelcomeText));

            //* tel & fax 
            $formatTel = $ets->getTelEts();
            $explodedFormatTel = preg_split('/[\/\-\s]+/', $formatTel);
            $formatTel = implode('.', $explodedFormatTel);
            $ets->setTelEts($formatTel);

            $formatFax = $ets->getFaxEts();
            $explodedFormatFax = preg_split('/[\/\-\s]+/', $formatFax);
            $formatFax = implode('.', $explodedFormatFax);
            $ets->setFaxEts($formatFax);


            //* mails
            $formatMail1 = $ets->getMail1Ets();
            $formatMail1 = trim(strtolower($formatMail1));
            $ets->setMail1Ets($formatMail1);
            
            $formatMail2 = $ets->getMail2Ets();
            $formatMail2 = trim(strtolower($formatMail2));
            $ets->setMail2Ets($formatMail2);
            
            //* horaires : voir comment faire accepter le code en bdd

            
            //* cp 
            if ( is_int($ets->getCpEts()) ) {
                $formatCp = $ets->getCpEts();
                $formatCp = trim($formatCp);
                $ets->setCpEts($formatCp);
            }

            //* ville
            $formatVille = $ets->getVilleEts();
            $formatVille = trim(strtoupper($formatVille));
            $ets->setVilleEts($formatVille);


            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'L\'entreprise a bien été modifiée !');

            return $this->redirectToRoute('ets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ets/edit.html.twig', [
            'et' => $ets,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="ets_delete", methods={"POST"})
     */
    public function delete(Request $request, Ets $ets): Response
    {
        if ($this->isCsrfTokenValid('delete' . $ets->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ets);
            $entityManager->flush(); 

            $this->addFlash('success', 'L\'entreprise a bien été supprimée !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('ets_index', [], Response::HTTP_SEE_OTHER);
    }
}
