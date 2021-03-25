<?php


namespace App\Form\Type\Security;


use Symfony\Component\Form\Extension\Core\Type\EmailType;

class SecurityEmailType extends EmailType
{
    /**
     * {@inheritdoc}
     */
    public function getParent(): ?string
    {
        return EmailType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'security_email';
    }

}