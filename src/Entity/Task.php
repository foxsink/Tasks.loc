<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\OneToOne;
use phpDocumentor\Reflection\Types\Collection;

/**
 * Class Task
 * @package App\Entity
 *
 * @ORM\Entity
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
     * @var Collection
     *
     * @ManyToOne  (targetEntity="Project", inversedBy="tasks")
     */
    private Collection $project;

    /**
     * @var string|null
     *
     * @ManyToOne (targetEntity="User")
     */
    private ?string $creator = null;

    /**
     * @var string|null
     *
     * @ORM\Column (type="string")
     */
    private ?string $title = null;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column (type="datetime")
     */
    private ?\DateTimeInterface $createdAt = null;

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
    public function getProject(): Collection
    {
        return $this->project;
    }

    /**
     * @param Collection $project
     * @return Task
     */
    public function setProject(Collection $project): Task
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
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return Task
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }


}