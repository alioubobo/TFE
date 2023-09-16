<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function contact(Request $request, MailerInterface $mailer, TranslatorInterface $translator): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $address = $data['email'];
            $content = $data['content'];

            $email = (new Email())
            ->from($address)              
            ->to($this->getParameter('app.mail_from_address'))
            ->subject('Prise de contact')
            ->text($content);

            $mailer->send($email);

            $message = $translator->trans('Your message has been sent');
            $this->addFlash('success', $message);
            
            return $this->redirectToRoute('app_home');            
        }

        return $this->renderForm('contact/contact.html.twig', [
            'form' => $form,
        ]);
    }
}
