<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Type\RegisterType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
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
     * @param Connection $connection
     *
     * @return Response
     *
     * @throws Exception
     */
    public function name(Request $request): Response
    {

        $task = new User();

        $form = $this->createForm(RegisterType::class, $task);
        $form->handleRequest($request);


        return $this->render('getname.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}