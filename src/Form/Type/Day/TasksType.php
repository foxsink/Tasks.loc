<?php

namespace App\Form\Type\Day;

use App\Entity\Project;
use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TasksType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("tasks", EntityType::class, [
                'class'         => Task::class,
                'placeholder'   => 'Select task',
                'label'         => false,
                'required'      => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'query_builder' => function(TaskRepository $repository) use ($options) {
                    return $repository->getQueryBuilder($options['data']);
                },
            ])
//            ->add("addNewTask", SubmitType::class, [
//                'attr' => [
//                    'class' => 'btn-primary btn',
//                ],
//                'label' => $options['btn-label'],
//            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class' => Project::class,
                'btn-label'  => 'Add new task'
            ])
            ->setAllowedTypes('btn-label', 'string')
        ;
    }
}