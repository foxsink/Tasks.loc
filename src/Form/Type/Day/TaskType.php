<?php

namespace App\Form\Type\Day;

use App\Object\DayTask;
use App\Entity\Task;
use App\Entity\TaskTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taskTitle', TextType::class, [
                'disabled' => true,
            ])
            ->add('taskTimes', CollectionType::class, [
                'entry_type'     => TaskTimeType::class,
                'entry_options'  => [
                    'year'  => $options['year'],
                    'month' => $options['month'],
                    'day'   => $options['day'],
                ],
                'allow_add'      => true,
                'allow_delete'   => true,
                'prototype'      => true,
                'by_reference'   => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'year'  => '2021',
                'month' => '03',
                'day'   => '13',
                'data_class' => DayTask::class
            ])
        ;
    }
}