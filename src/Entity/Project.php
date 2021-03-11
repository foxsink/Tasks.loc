<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="id", type="integer")
     *
     * @var int
     */
    protected int $id;

    /**
     * @ORM\Column(name="title", nullable=false, type="string")
     *
     * @var string
     */
    protected string $title;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     * @var bool
     */
    protected bool $isActive;
}