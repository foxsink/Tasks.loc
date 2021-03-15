<?php

namespace App\EventListener;

use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncodePrePersist
{
    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * @ORM\PrePersist()
     *
     * @param User $user
     * @param LifecycleEventArgs $args
     */
    public function encodePasswordPrePersist(User $user, LifecycleEventArgs $args)
    {

        $entity = $args->getObject();
        $entityManager = $args->getObjectManager();

        if($entity instanceof User)
            $user->setPassword($this->userPasswordEncoder->encodePassword($user, $user->getPassword()));
    }
}