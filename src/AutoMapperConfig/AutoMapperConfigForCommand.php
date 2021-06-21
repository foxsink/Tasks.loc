<?php

namespace App\AutoMapperConfig;

use App\Entity\Post;
use App\Object\PostObject;
use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use AutoMapperPlus\MappingOperation\Operation;
use Doctrine\ORM\EntityManagerInterface;

class AutoMapperConfigForCommand implements AutoMapperConfiguratorInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @inheritDoc
     */
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config
            ->registerMapping(PostObject::class, Post::class)
            ->beConstructedUsing(function (PostObject $object) {
                $post = $this->em->getRepository(Post::class)->findOneBy(['apiId' => $object->getId()]);
                return $post ?? new Post();
            })
            ->forMember('apiId', function (PostObject $object) {
                return $object->getId();
            })
            ->forMember('id', Operation::ignore())
        ;
    }
}