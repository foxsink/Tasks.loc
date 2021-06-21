<?php

namespace App\Object;

use JMS\Serializer\Annotation as JMS;

class PostsObject
{
    /**
     * @JMS\Type("array<App\Object\PostObject>")
     * @JMS\Inline()
     */
    private array $posts = [];

    /**
     * @return array
     */
    public function getPosts(): array
    {
        return $this->posts;
    }
}