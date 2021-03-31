<?php

namespace App\Form\Type\Day;

use App\Entity\Objects\UserProjectTask;
use App\Entity\Project;
use App\Form\DataTransformer\TaskIdToEntityTransformer;
use App\Validation\ValidationGroupResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DayReportType extends AbstractType
{

    private TaskIdToEntityTransformer $transformer;
    private ValidationGroupResolver $groupResolver;

    public function __construct(TaskIdToEntityTransformer $transformer, ValidationGroupResolver $groupResolver)
    {
        $this->transformer   = $transformer;
        $this->groupResolver = $groupResolver;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("project", EntityType::class, [
                'error_bubbling' => false,
                'class'          => Project::class,
                'placeholder'    => 'Select project',
            ])
            ->add('task', ChoiceType::class, [
                'choices' => [],
                'attr'    => [
                    'style' => 'display: none',
                ],
                'error_bubbling' => true,

            ])
            ->add('taskName', TextType::class, [
                'attr'   => [
                    'style' => 'display: none',
                    'placeholder' => 'Enter new task name',
                ],
                'required'       => false,
                'error_bubbling' => true,
            ])
            ->add('submit', SubmitType::class, [
                'attr'    => [
                    'style' => 'display: none',
                ],
            ])
        ;
        $builder->get('task')->resetViewTransformers();
        $builder->get('task')->addViewTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'data_class'        => UserProjectTask::class,
                'validation_groups' => $this->groupResolver,
            ])
        ;
    }
}