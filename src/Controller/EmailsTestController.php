<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailsTestController extends AbstractController
{
    #[Route('/emails/test', name: 'app_emails_test')]
    public function index(MailerInterface $mailer): Response
    {

        // letting the admin know a user has logged in (totally un relatistic scenario)
        $email = (new Email())
            ->from('app@example.com')
            ->to('admin@example.com')
            ->subject('test subject')
            ->text('test body');
    
        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return new Response($e->getMessage());
        }

        return $this->render('emails_test/index.html.twig', [
            'controller_name' => 'EmailsTestController',
        ]);
    }
}
