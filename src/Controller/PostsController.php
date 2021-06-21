<?php

namespace App\Controller;

use App\Entity\Post;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    /**
     * @Route("posts")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function postsList(PaginatorInterface $paginator, Request $request): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $pagination = $paginator->paginate($posts,$request->query->getInt('page', 1), 10);
        $pagination->setCustomParameters([
            'align' => 'center',
        ]);

        return $this->render('post/postsList.html.twig',[
            'pagination' => $pagination,
        ]);
    }
}