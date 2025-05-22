<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class EmailService
{

    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(
        string $to,
        string $subject,
        $body
    ) {
        

        // $from = $from ?? $_ENV["EMAIL_SENDER"];
        $email = (new Email())
            ->from("plicssy64@gmail.com")
            ->to($to)
            ->subject($subject)
            ->html($body);
        $this->mailer->send($email);
    }
}