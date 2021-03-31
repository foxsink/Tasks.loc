<?php

namespace App\Validator;

use App\Entity\Task;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class IsTaskInProjectValidator extends ConstraintValidator
{
    private PropertyAccessorInterface $propertyAccessor;

    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof IsTaskInProject) {
            throw new UnexpectedTypeException($constraint, IsTaskInProject::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

//        dump($propertyFromContext);
//        dump($propertyFromValue);
//        dump($value);
//        dd($this->context);
        $pathForContext = "object." . $constraint->propertyPathContext;
        $pathForValue   = $constraint->propertyPathValue;

        $propertyFromContext = $this->propertyAccessor->getValue($this->context, $pathForContext);

        if (!$pathForValue) {
            $propertyFromValue = $value;
        } else {
            $propertyFromValue = $this->propertyAccessor->getValue($value, $pathForValue);
        }

//        dump($propertyFromContext);
//        dump($propertyFromValue);
//        dump($value);
//        dd($this->context);

        if ($propertyFromContext !== $propertyFromValue) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ propertyFromValue }}', $propertyFromValue)
                ->setParameter('{{ propertyFromContext }}', $propertyFromContext)
                ->addViolation();
        }
    }
}