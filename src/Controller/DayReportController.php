<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\Type\Day\DayReportType;
use App\Form\Type\Day\TasksType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayReportController extends AbstractController
{
    /**
     * @Route("calendar/{year}/{month}/{day}", options={"expose" = true})
     *
     * @param int|null $year
     * @param int|null $month
     * @param int|null $day
     * @return mixed
     */
    public function dayReport(?int $year, ?int $month, ?int $day): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(DayReportType::class, $user);

        return $this->render('day_report/dayReport.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("dayReportAjax", options={"expose" = true})
     *
     * @param Request $request
     * @return mixed
     */
    public function dayReportAjax(Request $request): Response
    {
        if ($request->isXmlHttpRequest()) {
            $projectId = $request->request->get('projectId');
            $project = $this->getDoctrine()->getRepository(Project::class)->findOneBy(['id' => $projectId]);

            if (!$project) {
                throw $this->createNotFoundException();
            }

            $form = $this->createForm(TasksType::class, $project);
            return $this->render('day_report/components/tasksSelect.html.twig', [
                'form'        => $form->createView(),
                'projectId'   => $projectId,
                'submitRoute' => $this->generateUrl('app_task_addtask'),

            ]);
        } else {
            return $this->redirectToRoute('app_calendar_calendar');
        }

    }
}