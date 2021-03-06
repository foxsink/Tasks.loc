<?php

namespace App\Admin;

use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\FieldDescription\FieldDescriptionInterface;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class UserAdmin
 * @package App\Admin
 *
 * @property User $subject
 */
class UserAdmin extends AbstractAdmin
{
    /**
     * @param User $object
     */
    public function preUpdate($object)
    {
        $password = $this->getForm()->get('password')->getData() ?? $object->getPassword();

        $object->setPassword($password);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $new = is_null($this->subject->getId());

        $form
            ->add('id', NumberType::class, [
                'required' => false,
            ])
            ->add('email',TextType::class)
            ->add('password', TextType::class, [
                'required' => false,
                'mapped'   => $new,
            ])
            ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'choices'  => [
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_SUPERADMIN' => 'ROLE_SUPERADMIN',
                ],
            ])
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('tokenExpireAt',DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('allowLogin')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('email')
        ;
    }
    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->add('id')
            ->add('email')
            ->add('roles', FieldDescriptionInterface::TYPE_CHOICE, [
                'editable' => true,
                'multiple' => true,
                'choices'  => [
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_SUPERADMIN' => 'ROLE_SUPERADMIN',
                ],
            ])
            ->add('projects', null, [
                'associated_property' => 'title',
            ])
            ->add('firstName', null, [
                'editable' => true,
            ])
            ->add('lastName',null, [
                'editable' => true,
            ])
            ->add('tokenExpireAt',FieldDescriptionInterface::TYPE_DATETIME, [
                'editable' => true,
            ])
            ->add('allowLogin',null, [
                'editable' => true,
            ])
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
            ->add('email')
            ->add('roles')
            ->add('projects')
            ->add('firstName')
            ->add('lastName')
        ;
    }
}