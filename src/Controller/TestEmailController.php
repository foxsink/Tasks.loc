<?php

namespace App\Controller;

use App\Mailer\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestEmailController extends AbstractController
{

    /**
     * @Route("egg")
     */
    public function testAction(Mailer $mail): void
    {
        $mail->sendTest();
    }
}