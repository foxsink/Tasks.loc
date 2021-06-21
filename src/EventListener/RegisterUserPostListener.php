<?php

namespace App\EventListener;

use App\Event\RegisterUserEvent;
use App\Mailer\Mailer;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class RegisterUserPostListener
{
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function onRegisterUser(RegisterUserEvent $event)
    {
        $this->mailer->sendOnUserRegistered($event->getUser());
    }
}