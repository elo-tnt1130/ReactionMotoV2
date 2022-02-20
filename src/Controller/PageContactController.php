<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Ets;
use App\Form\ContactType;
use App\Repository\EtsRepository;
use App\Repository\PagesRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PageContactController extends AbstractController
{
    /**
     * @Route("/contact", name="page_contact")
     */
    public function index(Request $request, MailerInterface $mailer, EtsRepository $er, PagesRepository $pr): Response
    {

        $currentPage = 'Contactez-nous !';
        $pageData = $pr->findOneByTitle($currentPage);

        $ets = new Ets();
        $ets = $er->findAll();
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formatFirstname = trim(ucfirst(mb_convert_case($contact->getFirstname(), MB_CASE_LOWER)));
            $contact->setFirstname($formatFirstname);

            $formatLastname = trim(ucfirst(mb_convert_case($contact->getLastname(), MB_CASE_LOWER)));
            $contact->setLastname($formatLastname);

            $formatMail = trim(strtolower($contact->getMail()));
            $contact->setMail($formatMail);

            $formatSubject = trim(ucfirst(mb_convert_case($contact->getSubject(), MB_CASE_LOWER)));
            $contact->setSubject($formatSubject);

            $formatMessage = trim(ucfirst(mb_convert_case($contact->getMessage(), MB_CASE_LOWER)));
            $contact->setMessage($formatMessage);

            $email = (new TemplatedEmail())
                ->from(new Address('noreply@reactionmoto-beta.com'))
                ->to('reaction.moto@orange.fr')
                ->replyTo($contact->getMail())
                ->subject('Nouveau message du formulaire de contact')
                ->htmlTemplate('emails/mailcontact.html.twig')
                // ->textTemplate('emails/mailcontact.html.twig')
                ->context([
                    'contact' => $contact
                ]);

                // $email = (new Email())
                // ->from(new Address('noreply@reactionmoto.com'))
                // ->to('reaction.moto@orange.fr')
                // //->cc('cc@example.com')
                // //->bcc('bcc@example.com')
                // //->replyTo('fabien@example.com')
                // //->priority(Email::PRIORITY_HIGH)
                // ->subject('Time for Symfony Mailer!')
                // ->text('Sending emails is fun again!')
                // ->html('<p>See Twig integration for better HTML integration!</p>');

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé.');
            $contact = new Contact; 
            $form = $this->createForm(ContactType::class, $contact);

        }

        return $this->render('page_contact/index.html.twig', [
            'form' => $form->createView(),
            'ets' => $ets[0], 
            'currentPage' => $currentPage,
            'page' => $pageData
        ]);
    }
}