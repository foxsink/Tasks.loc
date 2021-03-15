<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * Class TaskTime
 * @package App\Entity
 *
 * @ORM\Entity
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
     * @var int|null
     *
     * @ManyToOne (targetEntity="Task")
     */
    private ?int $task = null;

    /**
     * @var int|null
     *
     * @ManyToOne (targetEntity="User")
     */
    private ?int $user = null;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?\DateTimeInterface $startedAt = null;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?\DateTimeInterface $endedAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getTask(): ?int
    {
        return $this->task;
    }

    /**
     * @param int|null $task
     * @return TaskTime
     */
    public function setTask(?int $task): TaskTime
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUser(): ?int
    {
        return $this->user;
    }

    /**
     * @param int|null $user
     * @return TaskTime
     */
    public function setUser(?int $user): TaskTime
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getStartedAt(): ?\DateTimeInterface
    {
        return $this->startedAt;
    }

    /**
     * @param \DateTimeInterface|null $startedAt
     * @return TaskTime
     */
    public function setStartedAt(?\DateTimeInterface $startedAt): TaskTime
    {
        $this->startedAt = $startedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getEndedAt(): ?\DateTimeInterface
    {
        return $this->endedAt;
    }

    /**
     * @param \DateTimeInterface|null $endedAt
     * @return TaskTime
     */
    public function setEndedAt(?\DateTimeInterface $endedAt): TaskTime
    {
        $this->endedAt = $endedAt;
        return $this;
    }

}