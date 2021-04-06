<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    public function findByUser(User $user)
    {
        $qb = $this->createQueryBuilder('p');
        $qb
            ->select('p')

            ->join('p.users', 'u')
        ;
        return $qb->getQuery()->getResult();
    }
}