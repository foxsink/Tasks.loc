<?php

namespace App\Object;

use JMS\Serializer\Annotation as JMS;

class Post
{

    /**
     * @JMS\SerializedName("userId")
     */
    private ?int $userId = null;

    private ?int $id = null;

    private ?string $title = null;

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


}