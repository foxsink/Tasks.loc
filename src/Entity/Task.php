<?php


namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

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
     *
     * @Groups("taskIdGroup")
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
     * @Gedmo\Blameable(on="create")
     */
    private ?User $creator = null;

    /**
     * @var Collection
     *
     * @OneToMany(targetEntity="App\Entity\TaskTime", mappedBy="task", cascade={"persist"}, orphanRemoval=true)
     */
    private Collection $taskTimes;

    /**
     * @var string|null
     *
     * @ORM\Column (type="string")
     *
     * @Groups("taskTitleGroup")
     */
    private ?string $title = null;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     * @Gedmo\Timestampable (on="create")
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
     * @param TaskTime $taskTime
     * @return $this
     */
    public function addTaskTime(TaskTime $taskTime): Task
    {
        $taskTime->setTask($this);
        $this->taskTimes->add($taskTime);
        return $this;
    }

    public function removeTaskTime(TaskTime $taskTime): Task
    {
        $this->taskTimes->removeElement($taskTime);
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