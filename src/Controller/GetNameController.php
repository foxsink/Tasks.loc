<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetNameController extends AbstractController
{
    /**
     * @Route("/getname")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function name(Request $request): Response
    {
        $name = $request->query->get('name');

        return $this->render('getname.html.twig', [
            'name' => $name,
        ]);
    }
}