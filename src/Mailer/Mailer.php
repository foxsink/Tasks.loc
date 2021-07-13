<?php

namespace App\Mailer;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Message;

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
                'token' => "http://80.89.192.241/token/$token",
                'username' => $to,
            ])
        ;
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw $e;
        }
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function sendOnUserRegistered(string $username)
    {
        $email = (new TemplatedEmail())
            ->from(new Address($this->address, $this->name))
            ->to('iar.karpov@gmail.com')
            ->subject('Verify registration.')
            ->embed(fopen('img/logo.png', 'r'), 'logo')
            ->htmlTemplate('email/onUserRegistered.html.twig')
            ->context([
                'to' => 'iar.karpov@gmail.com',
                'username' => $username,
            ])
        ;
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            throw $e;
        }
    }
}