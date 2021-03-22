<?php

namespace App\Admin;

use Doctrine\DBAL\Types\ArrayType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\FieldDescriptionInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\ProxyQueryInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProjectAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form
            ->add('id', null, [
                'required' => false,

            ])
            ->add('users', ModelAutocompleteType::class, [
                'property' => 'email',
                'multiple' => 'true',
//                'allow_add' => true,
//                'allow_delete' => true,

            ])
            ->add('title')
            ->add('active')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('title')
        ;
    }
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('users', FieldDescriptionInterface::TYPE_MANY_TO_MANY, [
//                'associated_property' => 'email',
//                'multiple'            => true,
//                'editable'            => true,
            ])
            ->add('title', null, ['editable' => true])
            ->add('active', null, ['editable' => true])
            ->add('_action', null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ]
            ])
        ;
    }
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('users')
            ->add('title')
            ->add('active')
        ;
    }
}