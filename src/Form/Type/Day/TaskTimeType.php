<?php

namespace App\Form\Type\Day;

use App\Entity\TaskTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskTimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('delete', ButtonType::class, [
                'attr'   => [
                    'class' => 'btn btn-primary delete_item',
                    'value' => 'Delete',
                ],
            ])
            ->add('description')
            ->add('startedAt', TimeType::class, [
                'reference_date' => new \DateTime(
                    "{$options['year']}-{$options['month']}-{$options['day']}"
                ),

            ])
            ->add('endedAt', TimeType::class, [
                'reference_date' => new \DateTime(
                    "{$options['year']}-{$options['month']}-{$options['day']}"
                ),
            ])

        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'year'  => '2021',
                'month' => '03',
                'day'   => '13',
                'data_class' => TaskTime::class
            ])
        ;
    }

}