<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Entity\Task;
use App\Entity\TaskTime;
use App\Entity\User;
use DateTime;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sonata\AdminBundle\Controller\CRUDController;
use Symfony\Component\HttpFoundation\Response;

class StatisticAdminController extends CRUDController
{
    /**
     * @ParamConverter(class="App\Entity\User", name="user")
     * @param string $date
     * @param User $user
     * @return Response
     * @throws Exception
     */
    public function dayAction(string $date, User $user): Response
    {
//        dd($user);

        /** @var TaskTime[] $taskTimes */
        $taskTimes = $this
            ->getDoctrine()
            ->getRepository(TaskTime::class)
            ->findTaskTimeForStatisticDay($user, new DateTime($date))
        ;
        $timeDiff = new DateTime("00:00:00");
        foreach ($taskTimes as $taskTime) {
            $timeDiff->add($taskTime->getStartedAt()->diff($taskTime->getEndedAt()));
        }
        return $this->renderWithExtraParams('admin/statisticDay.html.twig', [
            'taskTimes' => $taskTimes,
            'userEmail' => $user->getEmail(),
            'timeDiff'  => $timeDiff,
        ]);
    }

    public function listAction(): Response
    {
        $range = new \DatePeriod(new DateTime('-10 days midnight'), new \DateInterval('P1D'), new DateTime('+1 day midnight -1 sec'));
        $list = $this->getDoctrine()->getRepository(TaskTime::class)->findAllForStatisticPage($range);
        return $this->renderWithExtraParams('admin/statisticPage.html.twig', [
            'list' => $list
        ]);
    }

}