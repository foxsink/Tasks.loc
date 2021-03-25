<?php

namespace App\Repository;

use App\Entity\Project;
use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $entityClass = Task::class;
        parent::__construct($registry, $entityClass);
    }

    public function getQueryBuilder(Project $project): QueryBuilder
    {
        $qb = $this->createQueryBuilder('t');

        $qb
            ->andWhere('t.project = :project')
            ->setParameter('project', $project)
        ;
        return $qb;
    }
}