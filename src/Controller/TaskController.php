<?php

namespace App\Controller;

use App\Object\DayTask;
use App\Entity\Project;
use App\Entity\Task;
use App\Entity\TaskTime;
use App\Entity\User;
use App\Form\Type\Day\TaskType;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("task-time/{year}/{month}/{day}/task={id}", options={"expose" = true})
     * @ParamConverter("task", class="App\Entity\Task")
     * @param Request $request
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @param Task|null $task
     * @return Response
     */
    public function editTaskTime(Request $request, ?int $year, ?int $month, ?int $day, ?Task $task = null): Response
    {
        if (!$task) {
            return $this->redirectToRoute('app_calendar_calendar');
        }

        $object = new DayTask();
        $object
            ->setTaskTitle($task->getTitle())
            ->setTaskTimes(
                new ArrayCollection(
                    $this
                        ->getDoctrine()
                        ->getRepository(TaskTime::class)
                        ->findAllTaskTimesByDay($task, new \DateTime("$year-$month-$day"))
                )
            )
        ;
        $form = $this->createForm(TaskType::class, $object, [
            'year'  => $year,
            'month' => $month,
            'day'   => $day,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $this->getUser();
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($object->getTaskTimes() as $taskTime) {
                $taskTime
                    ->setUser($user)
                    ->setTask($task)
                ;
                $entityManager->persist($taskTime);
            }
            foreach ($object->getTaskTimesToDelete() as $taskTime) {
                $entityManager->remove($taskTime);
            }

            $task->setTitle($object->getTaskTitle());

            $entityManager->flush();

            return $this->redirectToRoute('app_task_edittasktime', [
                'year'  => $year,
                'month' => $month,
                'day'   => $day,
                'id' => $task->getId(),
            ]);
        }
        return $this->render('day_report/editTaskTime.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}