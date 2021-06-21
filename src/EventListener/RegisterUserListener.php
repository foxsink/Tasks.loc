<?php

namespace App\EventListener;

use App\Entity\Post;
use App\Event\RegisterUserEvent;
use App\Mailer\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class RegisterUserListener
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function onRegisterUser(RegisterUserEvent $event)
    {
        $post = new Post();
        $post
            ->setTitle("User {$event->getUser()->getEmail()} arrived on this site!")
            ->setBody("Welcome with open arms!")
            ->setUserId($event->getUser()->getId())
        ;
        $this->manager->persist($post);
        $this->manager->flush();
    }
}