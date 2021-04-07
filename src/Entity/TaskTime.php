<?php


namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class TaskTime
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\TaskTimeRepository")
 * @ORM\Table (name="tasks_times")
 */
class TaskTime
{

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue (strategy="AUTO")
     * @ORM\Column (name="id", type="integer")
     */
    private ?int $id = null;

    /**
     * @var Task|null
     *
     * @ManyToOne (targetEntity="Task", inversedBy="taskTimes", cascade={"persist"}))
     */
    private ?Task $task = null;

    /**
     * @var User|null
     *
     * @ManyToOne (targetEntity="User", inversedBy="userTimes")
     * @Gedmo\Blameable (on="create")
     */
    private ?User $user = null;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?DateTimeInterface $startedAt = null;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?DateTimeInterface $endedAt = null;


    /**
     * @var string|null
     *
     * @ORM\Column (type="string", nullable=true)
     */
    private ?string $description = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Task|null
     */
    public function getTask(): ?Task
    {
        return $this->task;
    }

    /**
     * @param Task|null $task
     * @return TaskTime
     */
    public function setTask(?Task $task): TaskTime
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return TaskTime
     */
    public function setUser(?User $user): TaskTime
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartedAt(): ?DateTimeInterface
    {
        return $this->startedAt;
    }

    /**
     * @param DateTimeInterface|null $startedAt
     * @return TaskTime
     */
    public function setStartedAt(?DateTimeInterface $startedAt): TaskTime
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndedAt(): ?DateTimeInterface
    {
        return $this->endedAt;
    }

    /**
     * @param DateTimeInterface|null $endedAt
     * @return TaskTime
     */
    public function setEndedAt(?DateTimeInterface $endedAt): TaskTime
    {
        $this->endedAt = $endedAt;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return TaskTime
     */
    public function setDescription(?string $description): TaskTime
    {
        $this->description = $description;
        return $this;
    }

    public function __toString()
    {
        return $this->description;
    }
}