<?php

namespace App\Form\Type\Security;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', SecurityEmailType::class, [
                'attr'  => [
                    'value' => $options['lastUsername'],
                ],
            ])
            ->add('password', SecurityPasswordType::class, [])
            ->add('login', SubmitType::class, [
                'label' => $options['btn-label'],
            ])
        ;
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'btn-label'    => "Go!",
                'lastUsername' => "",
                'csrf_protection' => true,
                'csrf_field_name' => '_csrf_token',
                'csrf_token_id'   => 'authenticate',
            ])
            ->setAllowedTypes('btn-label', ['string', 'null'])
            ->setAllowedTypes('lastUsername', ['string', 'null'])
        ;
    }
}