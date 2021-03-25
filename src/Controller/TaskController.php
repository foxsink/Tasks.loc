<?php

namespace App\Controller;

use App\Form\Type\Day\AddTaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{

    /**
     * @Route("addTask")
     */
    public function addTask():Response
    {
        $form = $this->createForm(AddTaskType::class);
        return $this->render('day_report/addTask.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}