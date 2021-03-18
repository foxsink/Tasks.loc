<?php


namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('id', TextType::class)
            ->add('email', TextType::class)
            ->add('roles', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('email')
            ->add('roles')
            ->add('firstName')
            ->add('lastName')

        ;
    }
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('email')
            ->add('roles')
            ->add('firstName')
            ->add('lastName')
        ;
    }
}