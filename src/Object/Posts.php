<?php

namespace App\Object;

use JMS\Serializer\Annotation as JMS;

class Posts
{
    /**
     * @JMS\Type("array<App\Object\Post>")
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