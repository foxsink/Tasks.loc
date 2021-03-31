<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTaskInProject extends Constraint
{
    public ?string $propertyPathValue = null;

    public ?string $propertyPathContext = null;

    public string $message = 'The "{{ propertyFromValue }}" is not contains "{{ propertyFromContext }}" property';

    public function validatedBy()
    {
        return static::class.'Validator';
    }
}