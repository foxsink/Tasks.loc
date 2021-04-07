<?php

namespace App\Controller;

use App\Entity\Objects\UserProjectTask;
use App\Entity\Project;
use App\Entity\Task;
use App\Form\Type\Day\DayReportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class DayReportController extends AbstractController
{

    /**
     * @Route("calendar/{year}/{month}/{day}", options={"expose" = true})
     *
     * @param Request $request
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @return Response
     */
    public function dayReport(Request $request, ?int $year, ?int $month, ?int $day): Response
    {
        $form = $this->createForm(DayReportType::class, $object = new UserProjectTask(), [
            'user' => $this->getUser(),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $object->getTask();

            if (!$task) {
                $task = (new Task())->setTitle($object->getTaskName());
                $task->setProject($object->getProject());
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($task);
                $entityManager->flush();
            }

            return $this->redirectToRoute('app_task_edittasktime', [
                'year'  => $year,
                'month' => $month,
                'day'   => $day,
                'id'    => $task->getId(),
            ]);

        }
        return $this->render('day_report/dayReport.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("day-report-ajax", options={"expose" = true})
     *
     * @param Request $request
     * @param SerializerInterface $serializer
     * @return mixed
     */
    public function dayReportAjax(Request $request, SerializerInterface $serializer): Response
    {
        if ($request->isXmlHttpRequest()) {
            $projectId = $request->request->get('projectId');
            $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy(['id' => $projectId]);

            if (!$project) {
                throw $this->createNotFoundException();
            }
            $json = $serializer->serialize(
                $project->getTasks(),
                'json',
                ['groups' => ['taskIdGroup', 'taskTitleGroup']]
            );

            return $this->json($json);
        }
        return $this->redirectToRoute('app_calendar_calendar');
    }
}