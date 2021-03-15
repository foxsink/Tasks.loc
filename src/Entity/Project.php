<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToMany;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * Class Project
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project
{

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private ?int $id = null;

    /**
     * @var Collection
     *
     * @ManyToMany(targetEntity="User", mappedBy="projects")
     */
    private Collection $users;

    /**
     * @var Collection
     *
     * @OneToMany(targetEntity="Task", mappedBy="project")
     */
    private Collection $tasks;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $title = null;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private bool $active = true;

    /**
     * Project constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param Collection $users
     * @return Project
     */
    public function setUsers($users)
    {
        $this->users = $users;
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
     * @return Project
     */
    public function setTitle(?string $title): Project
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Project
     */
    public function setActive(bool $active): Project
    {
        $this->active = $active;
        return $this;
    }
}