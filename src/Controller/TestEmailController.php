<?php

namespace App\Controller;

use App\Mailer\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TestEmailController extends AbstractController
{

    /**
     * @Route("egg")
     */
    public function testAction(Mailer $mail, KernelInterface $appKernel): RedirectResponse
    {
        $im = imagecreatetruecolor(360, 360);

// Create some colors
        $bgColor = imagecolorallocate($im, 16, 39, 62);
        $linkColor = imagecolorallocate($im, 30, 206, 122);
        $textColor = imagecolorallocate($im, 255, 255, 255);
        imagefilledrectangle($im, 0, 0, 359, 359, $bgColor);

// The text to draw
        $text = 'Testing...';
        $link = 'Testing...';
// Replace path by your own font path
        $font = $appKernel->getProjectDir() . '/fonts/Roboto-Regular.ttf';

// Add the text
        imagettftext($im, 14, 0, 2, 2, $textColor, $font, $text);
        imagettftext($im, 14, 0, 2, 22, $linkColor, $font, $link);

// Using imagepng() results in clearer text compared with imagejpeg()
        imagepng($im, $appKernel->getProjectDir() . '/public/img/test.png');
        sleep(4);
        $mail->sendTest();
        return $this->redirect('http://80.89.192.241/public/img/test.png');
    }
}