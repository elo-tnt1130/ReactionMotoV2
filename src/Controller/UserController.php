<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Mime\Encoder\EncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @Route("/admin/user")
 * @IsGranted("ROLE_DEV")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordHasherInterface $uph): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatPseudo = $user->getPseudo();
            $formatPseudo = trim($formatPseudo);
            $user->setPseudo($formatPseudo);
            
            $formatPrenom = $user->getPrenomUser();
            $formatPrenom = trim(ucfirst(mb_convert_case($formatPrenom, MB_CASE_LOWER)));
            $user->setPrenomUser($formatPrenom);

            $formatNom = $user->getNomUser();
            $formatNom = trim(ucfirst(mb_convert_case($formatNom, MB_CASE_LOWER)));
            $user->setNomUser($formatNom);
            
            $mdp = $form->get("password")->getData();
            $mdp = $uph->hashPassword($user, $mdp);
            $user->setPassword($mdp);

            $file = $form->get('avatar_user')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "avatar-" . $_POST["users"]["pseudo"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $user->setAvatarUser($uploadedfile);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été ajouté !');

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordHasherInterface $uph): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatPseudo = $user->getPseudo();
            $formatPseudo = trim($formatPseudo);
            $user->setPseudo($formatPseudo);
            
            $formatPrenom = $user->getPrenomUser();
            $formatPrenom = trim(ucfirst(mb_convert_case($formatPrenom, MB_CASE_LOWER)));
            $user->setPrenomUser($formatPrenom);

            $formatNom = $user->getNomUser();
            $formatNom = trim(ucfirst(mb_convert_case($formatNom, MB_CASE_LOWER)));
            $user->setNomUser($formatNom);
            
            $mdp = $form->get("password")->getData();
            $mdp = $uph->hashPassword($user, $mdp);
            $user->setPassword($mdp);

            $file = $form->get('avatar_user')->getData();

            if ($file) {
                $uploadedfile = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $uploadedfile = "avatar-" . $_POST["user"]["pseudo"];
                $uploadedfile = str_replace(" ", "_", $uploadedfile);
                $uploadedfile .= "_" . uniqid() . "." . $file->guessExtension();
                $file->move('img/', $uploadedfile);
                $user->setAvatarUser($uploadedfile);
            }


            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été modifié !');

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {

            $file = $user->getAvatarUser();

            if ($file!=null && file_exists('img/' . $file)) {
                unlink('img/' . $file);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
            $this->addFlash('success', 'L\'utilisateur a bien été supprimé !');
        } else {
            $this->addFlash('danger', 'Une erreur est survenue !');
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
