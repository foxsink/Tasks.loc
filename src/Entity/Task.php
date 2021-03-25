<?php


namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Class Task
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 * @ORM\Table (name="tasks")
 */
class Task
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
     * @var Project
     *
     * @ManyToOne  (targetEntity="Project", inversedBy="tasks")
     */
    private Project $project;

    /**
     * @var User|null
     *
     * @ManyToOne (targetEntity="User")
     */
    private ?User $creator = null;

    /**
     * @var Collection
     *
     * @OneToMany(targetEntity="App\Entity\TaskTime", mappedBy="task")
     */
    private Collection $taskTimes;

    /**
     * @var string|null
     *
     * @ORM\Column (type="string")
     */
    private ?string $title = null;
    //TODO figure ^(string) out
    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?DateTimeInterface $createdAt = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Project
     */
    public function getProject(): Project
    {
        return $this->project;
    }

    /**
     * @param Project $project
     * @return Task
     */
    public function setProject(Project $project): Task
    {
        $this->project = $project;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreator(): ?string
    {
        return $this->creator;
    }

    /**
     * @param string|null $creator
     * @return Task
     */
    public function setCreator(?string $creator): Task
    {
        $this->creator = $creator;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Task
     */
    public function setTitle(?string $title): Task
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param DateTimeInterface|null $createdAt
     * @return Task
     */
    public function setCreatedAt(?DateTimeInterface $createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getTaskTimes(): Collection
    {
        return $this->taskTimes;
    }

    /**
     * @param Collection $taskTimes
     * @return Task
     */
    public function setTaskTimes(Collection $taskTimes): Task
    {
        $this->taskTimes = $taskTimes;
        return $this;
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->title;
    }
}