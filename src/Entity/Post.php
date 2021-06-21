<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * Class Project
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="posts")
 */
class Post
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
     * @var int|null
     *
     * @ORM\Column(type="integer")
     */
    private ?int $userId = null;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $apiId = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $title = null;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    private ?string $body = null;

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return Post
     */
    public function setUserId(?int $userId): Post
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Post
     */
    public function setId(?int $id): Post
    {
        $this->id = $id;
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
     * @return Post
     */
    public function setTitle(?string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return Post
     */
    public function setBody(?string $body): Post
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getApiId(): ?int
    {
        return $this->apiId;
    }

    /**
     * @param int|null $apiId
     * @return Post
     */
    public function setApiId(?int $apiId): Post
    {
        $this->apiId = $apiId;
        return $this;
    }


}