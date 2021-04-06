<?php

namespace App\RegisterToken;

use App\Entity\User;
use App\Exception\ExpiredTokenException;
use App\Exception\UsedTokenException;
use App\Exception\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Security\Core\Exception\InvalidArgumentException;

class TokenGenerator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    protected function generate(int $length = 20): string
    {
        try {
            $bytes = random_bytes(ceil($length / 2));
        } catch (Exception $e) {
            throw new Exception("Function random_bytes is not available.");
        }
        return substr(bin2hex($bytes), 0, $length);
    }

    /**
     * @param User $user
     * @return string
     * @throws Exception
     */
    public function createToken(User $user): string
    {
        $token = $this->generate();
        $user->setRegisterToken($token);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $token;
    }

    /**
     * @param string|null $token
     * @return User
     * @throws ExpiredTokenException
     * @throws UsedTokenException
     * @throws UserNotFoundException
     */
    public function activateUserByToken(?string $token = null): User
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['registerToken' => $token]);
        if (!$user) {
            throw new UserNotFoundException("Token not found");
        }

        if (new \DateTime() > $user->getTokenExpireAt()) {
            throw new ExpiredTokenException();
        }

        if ($user->getAllowLogin()) {
            throw new UsedTokenException();
        }
        $user->setAllowLogin(true);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}