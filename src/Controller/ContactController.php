<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contactForm = $this->createForm(ContactFormType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $data = $contactForm->getData();
            $errors = [];

            if (empty($data['email'])) {
                $errors[] = 'Veuillez entrer votre adresse e-mail.';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Votre adresse e-mail est invalide.';
            }
            if (empty($data['subject'])) {
                $errors[] = 'Veuillez entrer un sujet.';
            }
            if (empty($data['message'])) {
                $errors[] = 'Veuillez entrer un message.';
            }

            if (!empty($errors)) {
                return $this->render('contact/index.html.twig', [
                    'data' => $data,
                    'errors' => $errors,
                    'contactForm' => $contactForm->createView()
                ]);
            }

            $content = 'Un nouveau message a été envoyé grâce au formulaire de contact.' . PHP_EOL . PHP_EOL;
            $content .= 'Email = ' . $data['email'] . PHP_EOL;
            if (!empty($data['subject'])) {
                $content .= 'Sujet = ' . $data['subject'] . PHP_EOL;
            }
            $content .= 'Message = ' . $data['message'] . PHP_EOL;

            $email = (new TemplatedEmail())
                ->from($data['email'])
                ->to('robin.falck57@gmail.com')
                ->subject($data['subject'])
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact' => $data
                ]);

            $mailer->send($email);

            return $this->render('contact/index.html.twig', [
                'contactForm' => $contactForm->createView(),
                'success' => 'yes'
            ]);
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView()
        ]);
    }
}
