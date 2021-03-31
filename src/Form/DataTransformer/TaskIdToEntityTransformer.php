<?php


namespace App\Form\DataTransformer;


use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMException;
use Symfony\Component\Form\DataTransformerInterface;

class TaskIdToEntityTransformer implements DataTransformerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function transform($value): ?int
    {
        if($value === null)
        {
            return null;
        }
        return $value->getId();
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value)
    {
        return $this->entityManager->getRepository(Task::class)->findOneBy(['id' => $value]);

    }
}