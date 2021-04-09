<?php

namespace App\Entity\Objects;

use App\Entity\TaskTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class DayTask
{
    private ?string $taskTitle = null;

    private Collection $taskTimes;

    private Collection $taskTimesToDelete;

    public function __construct()
    {
        $this->taskTimes = new ArrayCollection();
        $this->taskTimesToDelete = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getTaskTitle(): ?string
    {
        return $this->taskTitle;
    }

    /**
     * @param string|null $taskTitle
     * @return DayTask
     */
    public function setTaskTitle(?string $taskTitle): DayTask
    {
        $this->taskTitle = $taskTitle;
        return $this;
    }

    /**
     * @return ArrayCollection|Collection|TaskTime[]
     */
    public function getTaskTimes()
    {
        return $this->taskTimes;
    }

    /**
     * @param ArrayCollection|Collection $taskTimes
     * @return DayTask
     */
    public function setTaskTimes(Collection $taskTimes): DayTask
    {
        $this->taskTimes = $taskTimes;
        return $this;
    }

    public function addTaskTime(TaskTime $taskTime)
    {
        $this->taskTimes->add($taskTime);
    }

    public function removeTaskTime(TaskTime $taskTime)
    {
        $this->taskTimes->removeElement($taskTime);
        $this->taskTimesToDelete->add($taskTime);
    }

    /**
     * @return ArrayCollection|Collection
     */
    public function getTaskTimesToDelete()
    {
        return $this->taskTimesToDelete;
    }
}