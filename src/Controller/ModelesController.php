<?php

namespace App\Controller;

use App\Entity\Couleurs;
use App\Entity\Modeles;
use App\Form\ModelesType;
use App\Repository\ModelesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin/modeles")
 * @IsGranted("ROLE_ADMIN")
 */
class ModelesController extends AbstractController
{
    /**
     * @Route("/", name="modeles_index", methods={"GET"})
     */
    public function index(ModelesRepository $modelesRepository): Response
    {
        return $this->render('modeles/index.html.twig', [
            'modeles' => $modelesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="modeles_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $modele = new Modeles();
        $form = $this->createForm(ModelesType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibModele = $modele->getLibModele();
            $formatLibModele = trim(ucfirst(mb_convert_case($formatLibModele, MB_CASE_LOWER)));
            $modele->setLibModele($formatLibModele);

            $formatKilometrage = $modele->getKilometrageOccasion();
            $formatKilometrage = trim(ucfirst(mb_convert_case($formatKilometrage, MB_CASE_LOWER)));
            $modele->setKilometrageOccasion($formatKilometrage);

            $formatLien = $modele->getLienOccasion();
            $formatLien = trim($formatLien);
            $modele->setLienOccasion($formatLien);

            $formatLongueurMoto = $modele->getLongueurNeuf();
            $formatLongueurMoto = intval(trim($formatLongueurMoto));
            $modele->setLongueurNeuf($formatLongueurMoto);
            
            $formatLargeur = $modele->getLargeurNeuf();
            $formatLargeur = intval(trim($formatLargeur));
            $modele->setLargeurNeuf($formatLargeur);
            
            $formatHauteurSelle = $modele->getHauteurSelleNeuf();
            $formatHauteurSelle = intval(trim($formatHauteurSelle));
            $modele->setHauteurSelleNeuf($formatHauteurSelle);

            $formatPoidsMoto = $modele->getPoidsNeuf();
            $formatPoidsMoto = intval(trim($formatPoidsMoto));
            $modele->setPoidsNeuf($formatPoidsMoto);

            $formatConso = $modele->getConsoNeuf();
            $formatConso = floatval(trim(str_replace(",", ".", $formatConso)));
            $modele->setConsoNeuf($formatConso);

            $formatPrix = $modele->getPrixMoto();
            $formatPrix = floatval(trim(str_replace(",", ".", $formatPrix)));
            $modele->setPrixMoto($formatPrix);

            $img1 = $form->get('img1_moto')->getData();
            if (isset($_FILES['modeles']['name']['img1_moto'])) {
                $uploadedfileImg1 = pathinfo($img1->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg1 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg1 = str_replace(" ", "_", $uploadedfileImg1);
                $uploadedfileImg1 .= "_" . uniqid() . "." . $img1->guessExtension();
                $img1->move('img/', $uploadedfileImg1);
                $modele->setImg1Moto($uploadedfileImg1);
            }

            $img2 = $form->get('img2_moto')->getData();
            if (isset($img2)) {
                $uploadedfileImg2 = pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg2 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg2 = str_replace(" ", "_", $uploadedfileImg2);
                $uploadedfileImg2 .= "_" . uniqid() . "." . $img2->guessExtension();
                $img2->move('img/', $uploadedfileImg2);
                $modele->setImg2Moto($uploadedfileImg2);
            }

            $img3 = $form->get('img3_moto')->getData();
            if ($_FILES['modeles']['name']['img3_moto']) {
                $uploadedfileImg3 = pathinfo($img3->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg3 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg3 = str_replace(" ", "_", $uploadedfileImg3);
                $uploadedfileImg3 .= "_" . uniqid() . "." . $img3->guessExtension();
                $img3->move('img/', $uploadedfileImg3);
                $modele->setImg3Moto($uploadedfileImg3);
            }

            $img4 = $form->get('img4_moto')->getData();
            if ($_FILES['modeles']['name']['img4_moto']) {
                $uploadedfileImg4 = pathinfo($img4->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg4 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg4 = str_replace(" ", "_", $uploadedfileImg4);
                $uploadedfileImg4 .= "_" . uniqid() . "." . $img4->guessExtension();
                $img4->move('img/', $uploadedfileImg4);
                $modele->setImg4Moto($uploadedfileImg4);
            }


            $filePDF = $form->get('fiche_technique_neuf')->getData();
            if (isset($filePDF)) {
                $uploadedfilePDF = pathinfo($filePDF->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfilePDF = "pdf-" . $_POST["modeles"]["lib_modele"];
                $uploadedfilePDF = str_replace(" ", "_", $uploadedfilePDF);
                $uploadedfilePDF .= "_" . uniqid() . "." . $filePDF->guessExtension();
                $filePDF->move('dl/', $uploadedfilePDF);
                $modele->setFicheTechniqueNeuf($uploadedfilePDF);
            }


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modele);
            $entityManager->flush();

            $this->addFlash('success', 'Le modèle a bien été ajouté !');

            return $this->redirectToRoute('modeles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modeles/new.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="modeles_show", methods={"GET"})
     */
    public function show(Modeles $modele): Response
    {
        return $this->render('modeles/show.html.twig', [
            'modele' => $modele,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="modeles_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Modeles $modele): Response
    {
        $form = $this->createForm(ModelesType::class, $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatLibModele = $modele->getLibModele();
            $formatLibModele = trim(ucfirst(mb_convert_case($formatLibModele, MB_CASE_LOWER)));
            $modele->setLibModele($formatLibModele);

            $formatKilometrage = $modele->getKilometrageOccasion();
            $formatKilometrage = trim(ucfirst(mb_convert_case($formatKilometrage, MB_CASE_LOWER)));
            $modele->setKilometrageOccasion($formatKilometrage);

            $formatLien = $modele->getLienOccasion();
            // dump($modele);
            $formatLien = ($formatLien != null)?trim($formatLien):"www.reactionmoto.com/page/com";
            $modele->setLienOccasion($formatLien);
            // dd($formatLien);

            $formatLongueurMoto = $modele->getLongueurNeuf();
            $formatLongueurMoto = intval(trim($formatLongueurMoto));
            $modele->setLongueurNeuf($formatLongueurMoto);
            
            $formatLargeur = $modele->getLargeurNeuf();
            $formatLargeur = intval(trim($formatLargeur));
            $modele->setLargeurNeuf($formatLargeur);
            
            $formatHauteurSelle = $modele->getHauteurSelleNeuf();
            $formatHauteurSelle = intval(trim($formatHauteurSelle));
            $modele->setHauteurSelleNeuf($formatHauteurSelle);

            $formatConso = $modele->getConsoNeuf();
            $formatConso = floatval(trim(str_replace(",", ".", $formatConso)));
            $modele->setConsoNeuf($formatConso);

            $formatPrix = $modele->getPrixMoto();
            $formatPrix = floatval(trim(str_replace(",", ".", $formatPrix)));
            $modele->setPrixMoto($formatPrix);


            // $oldImg1 = $modele->getImg1Moto();
            $img1 = $form->get('img1_moto')->getData();
            if (isset($img1)) {

                // if(!is_null($img1) && file_exists('/img/'.$oldImg1)) { 
                //     unlink('/img/'.$oldImg1);
                // }

                $uploadedfileImg1 = pathinfo($img1->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg1 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg1 = str_replace(" ", "_", $uploadedfileImg1);
                $uploadedfileImg1 .= "_" . uniqid() . "." . $img1->guessExtension();
                $img1->move('img/', $uploadedfileImg1);
                $modele->setImg1Moto($uploadedfileImg1);
            }

            $img2 = $form->get('img2_moto')->getData();
            if (isset($img2)) {
                $uploadedfileImg2 = pathinfo($img2->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg2 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg2 = str_replace(" ", "_", $uploadedfileImg2);
                $uploadedfileImg2 .= "_" . uniqid() . "." . $img2->guessExtension();
                $img2->move('img/', $uploadedfileImg2);
                $modele->setImg2Moto($uploadedfileImg2);
            }

            $img3 = $form->get('img3_moto')->getData();
            if (isset($img3)) {
                $uploadedfileImg3 = pathinfo($img3->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg3 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg3 = str_replace(" ", "_", $uploadedfileImg3);
                $uploadedfileImg3 .= "_" . uniqid() . "." . $img3->guessExtension();
                $img3->move('img/', $uploadedfileImg3);
                $modele->setImg3Moto($uploadedfileImg3);
            }

            $img4 = $form->get('img4_moto')->getData();
            if (isset($img4)) {
                $uploadedfileImg4 = pathinfo($img4->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfileImg4 = "img-" . $_POST["modeles"]["lib_modele"];
                $uploadedfileImg4 = str_replace(" ", "_", $uploadedfileImg4);
                $uploadedfileImg4 .= "_" . uniqid() . "." . $img4->guessExtension();
                $img4->move('img/', $uploadedfileImg4);
                $modele->setImg4Moto($uploadedfileImg4);
            }


            $filePDF = $form->get('fiche_technique_neuf')->getData();
            if (isset($filePDF)) {
                $uploadedfilePDF = pathinfo($filePDF->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfilePDF = "pdf-" . $_POST["modeles"]["lib_modele"];
                $uploadedfilePDF = str_replace(" ", "_", $uploadedfilePDF);
                $uploadedfilePDF .= "_" . uniqid() . "." . $filePDF->guessExtension();
                $filePDF->move('dl/', $uploadedfilePDF);
                $modele->setFicheTechniqueNeuf($uploadedfilePDF);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Le modèle a bien été modifié !');

            return $this->redirectToRoute('modeles_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('modeles/edit.html.twig', [
            'modele' => $modele,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="modeles_delete", methods={"POST"})
     */
    public function delete(Request $request, Modeles $modele): Response
    {
        if ($this->isCsrfTokenValid('delete' . $modele->getId(), $request->request->get('_token'))) {

            // $files = [$modele->getImg1Moto(), $modele->getImg2Moto(), $modele->getImg3Moto(), $modele->getImg4Moto()]

            $file1 = $modele->getImg1Moto();
            if (file_exists('img/' . $file1)) {
                unlink('img/' . $file1);
            }

            $file2 = $modele->getImg2Moto();
            if ($file2!=null && file_exists('img/' . $file2)) {
                unlink('img/' . $file2);
            }
            // dd($modele);
            
            $file3 = $modele->getImg3Moto();
            if ($file3!=null && file_exists('img/' . $file3)) {
                unlink('img/' . $file3);
            }
            
            $file4 = $modele->getImg4Moto();
            if ($file4!=null && file_exists('img/' . $file4)) {
                unlink('img/' . $file4);
            }

            $filePDF = $modele->getFicheTechniqueNeuf();
            if ($filePDF!=null && file_exists('dl/' . $filePDF)) {
                unlink('dl/' . $filePDF);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modele);
            $entityManager->flush();

            $this->addFlash('success', 'Le modèle a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('modeles_index', [], Response::HTTP_SEE_OTHER);
    }
}
