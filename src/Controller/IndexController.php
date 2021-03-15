<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route ("")
     *
     * @return Response
     */
    public function index(): Response
    {

//        $username = $this->getUser()->getUsername();
        return $this->render('index.html.twig', [
            'title' => 'Index',
//         'username' => $username,

        ]);
    }
}