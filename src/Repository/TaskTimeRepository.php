<?php

namespace App\Repository;

use App\Entity\Task;
use App\Entity\TaskTime;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskTime::class);
    }

    public function findAllForStatisticPage(\DatePeriod $range)
    {
        $start = $range->start->format('Y-m-d H:i:s');
        $end = $range->end->format('Y-m-d H:i:s');
        $qb = $this->createQueryBuilder('tt');
        $qb
            ->select('u.email')
            ->addSelect('u.id')
            ->addSelect('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(tt.endedAt, tt.startedAt)))) AS time_diff_sum')
            ->addSelect('DATE(tt.startedAt) AS date')

            ->join('tt.user', 'u')

            ->where($qb->expr()->between('tt.startedAt', ':start', ':end'))
            ->andWhere($qb->expr()->between('tt.endedAt', ':start', ':end'))

            ->setParameters([
                'start' => $start,
                'end'   => $end,
            ])

            ->groupBy('u.id, date')
        ;
        return $qb->getQuery()->getResult();
    }

    public function findTaskTimeForStatisticDay(User $user, \DateTime $date)
    {
        $start = $date->modify('midnight');
        $end = clone $start;
        $end = $end->modify('+1 day');
        $qb = $this->createQueryBuilder('tt');
        $qb
            ->leftJoin('tt.user', 'u')

            ->where('u.id = :user')
            ->andWhere('tt.startedAt BETWEEN :start AND :end')
            ->andWhere('tt.endedAt BETWEEN :start AND :end')

            ->setParameters([
                'user' => $user->getId(),
                'start' => $start,
                'end' => $end,
            ])
        ;
        return $qb->getQuery()->getResult();
    }

    public function findAllTaskTimesByDay(Task $task, \DateTime $date)
    {
        $start = $date->modify('midnight');
        $end = clone $start;
        $end = $end->modify('+1 day');
        $qb = $this->createQueryBuilder('tt');
        $qb
            ->where('tt.task = :id')
            ->andWhere('tt.startedAt BETWEEN :start AND :end')
            ->andWhere('tt.endedAt BETWEEN :start AND :end')

            ->setParameters([
                'id' => $task->getId(),
                'start' => $start,
                'end' => $end,
            ])
        ;
        return $qb->getQuery()->getResult();
    }
}