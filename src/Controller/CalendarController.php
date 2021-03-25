<?php

namespace App\Controller;

use App\Form\Type\Calendar\CalendarType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("calendar/{year}/{month}")
     *
     * @param int|null $year
     * @param int|null $month
     *
     * @return Response
     */
    public function calendar(?int $year = null, ?int $month = null): Response
    {
        $year  = $year ?? date('Y');
        $month = $month ?? date('m');

        $startDatetime = DateTime::createFromFormat('Y-m', "$year-$month");

        $startDatetime->modify('last monday of last month');
        $endDatetime = clone $startDatetime;
        $endDatetime->modify('+6 week');

        $currentMonth = new \DatePeriod(
            $startDatetime,
            new \DateInterval('P1D'),
            $endDatetime
        );
        $form = $this->createForm(CalendarType::class);
        return $this->render('calendar/calendar.html.twig', [
            'form'         => $form->createView(),
            'currentMonth' => $currentMonth,
            'month'        => $startDatetime->modify('+2 week'),

            ]);
    }

    /**
     * @Route("submitMonth")
     * @param Request $request
     */
    public function submitMonth(Request $request): RedirectResponse
    {
        $date = $request->request->get("calendar")['selectMonth'];
        unset($date['day']);
        return $this->redirectToRoute('app_calendar_calendar', $date);
    }
}