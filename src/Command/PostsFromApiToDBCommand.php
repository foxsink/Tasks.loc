<?php

namespace App\Command;

use App\Entity\Post;
use App\Object\PostsObject;
use AutoMapperPlus\AutoMapperInterface;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PostsFromApiToDBCommand extends Command
{
    protected static $defaultName = 'app:database:api:update';

    private SerializerInterface $serializer;
    private EntityManagerInterface $entityManager;
    private AutoMapperInterface $mapper;
    private ClientInterface $client;

    public function __construct(
        SerializerInterface $serializer,
        AutoMapperInterface $mapper,
        EntityManagerInterface $entityManager,
        ClientInterface $myClient
    )
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->mapper = $mapper;
        $this->client = $myClient;
    }


    protected function configure()
    {
        $this
            ->setDescription('Update db data')
            ->setHelp('This command allows you to update database data form api.')
        ;
    }

    /**
     * @throws GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $response = $this->client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $body = $response->getBody()->getContents();

        if (!$body) {
            $output->writeln('Response on null');
            return 1;
        }

        /** @var PostsObject $postsObject */
        $postsObject = $this->serializer->deserialize($body,PostsObject::class,'json');

        if (!$postsObject) {
            $output->writeln('Deserialize problem');
            return 1;
        }

        $posts = $this->mapper->mapMultiple($postsObject->getPosts(), Post::class);
        if (!$posts) {
            $output->writeln('Mapping problem');
            return 1;
        }
        foreach ($posts as $post) {
            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();
        $output->writeln('Success!');
        return 0;
    }
}