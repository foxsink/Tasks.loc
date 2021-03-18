<?php

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SecurityPasswordType extends PasswordType
{
    /**
     * {@inheritdoc}
     */
    public function getParent(): ?string
    {
        return PasswordType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'security_password';
    }
}