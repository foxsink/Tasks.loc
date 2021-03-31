<?php


namespace App\Validation;


use Symfony\Component\Form\FormInterface;

class ValidationGroupResolver
{
//    private $service1;
//
//    private $service2;
//
//    public function __construct($service1, $service2)
//    {
//        $this->service1 = $service1;
//        $this->service2 = $service2;
//    }

    public function __invoke(FormInterface $form): array
    {
        $groups = ['addtask'];
        if ($form->get('task')->getData()) {
            $groups = ['task'];
        }

        return $groups;
    }
}