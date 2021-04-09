<?php

namespace App\Controller;

use App\Object\Post;
use App\Object\Posts;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    /**
     * @Route("posts")
     * @param SerializerInterface $serializer
     * @return Response
     * @throws GuzzleException
     */
    public function postsList(SerializerInterface $serializer): Response
    {
        $client = new Client();
        try {
            $response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        } catch (GuzzleException $e) {
            throw $e;
        }
        $body = $response->getBody()->getContents();
//        dd($body);
        $posts = $serializer->deserialize($body,Posts::class,'json');
        return $this->render('post/postsList.html.twig',[
            'statusCode' => $response->getStatusCode(),
            'posts'       => $posts->getPosts(),
            'header'     => $response->getHeaderLine('content-type'),
        ]);
    }
}