<?php

namespace App\Object;

use App\Validator as ProjectAssert;
use App\Entity\Project;
use App\Entity\Task;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UserProjectTask
 * @package App\Entity\Object
 */
class UserProjectTask
{
    /**
     * @ProjectAssert\IsTaskInProject(propertyPathContext="task.project", groups="task")
     * @Assert\NotNull(groups={"addtask", "task"})
     */
    private ?Project $project = null;

    /**
     * @var Task|null
     * @Assert\IsNull(groups="addtask")
     * @Assert\NotNull(groups="task")
     */
    private ?Task $task = null;
    /**
     * @var string|null
     * @Assert\NotBlank(groups="addtask")
     * @Assert\IsNull(groups="task")
     */
    private ?string $taskName = null;

    /**
     * @return Project|null
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * @param Project|null $project
     * @return UserProjectTask
     */
    public function setProject(?Project $project): UserProjectTask
    {
        $this->project = $project;
        return $this;
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
     * @return UserProjectTask
     */
    public function setTask(?Task $task): UserProjectTask
    {
        $this->task = $task;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTaskName(): ?string
    {
        return $this->taskName;
    }

    /**
     * @param string|null $taskName
     * @return UserProjectTask
     */
    public function setTaskName(?string $taskName): UserProjectTask
    {
        $this->taskName = $taskName;
        return $this;
    }



}