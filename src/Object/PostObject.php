<?php

namespace App\Object;

use JMS\Serializer\Annotation as JMS;

class PostObject
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
     * @return PostObject
     */
    public function setUserId(?int $userId): PostObject
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
     * @return PostObject
     */
    public function setId(?int $id): PostObject
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
     * @return PostObject
     */
    public function setTitle(?string $title): PostObject
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
     * @return PostObject
     */
    public function setBody(?string $body): PostObject
    {
        $this->body = $body;
        return $this;
    }


}