<?php

namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    private string $address;
    private string $name;
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer, string $address, string $name)
    {
        $this->address = $address;
        $this->name = $name;
        $this->mailer = $mailer;
    }

    /**
     * @param string $to
     * @param string $token
     * @throws TransportExceptionInterface
     */
    public function sendVerifyEmail(string $to, string $token)
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->address, $this->name))
            ->to($to)
            ->subject('Verify registration.')
            ->embed(fopen('img/logo.png', 'r'), 'logo')
            ->htmlTemplate('email/Email.html.twig')
            ->context([
                'token' => "Tasks.loc/token/$token",
                'username' => $to,
            ])
        ;
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw $e;
        }
    }
}