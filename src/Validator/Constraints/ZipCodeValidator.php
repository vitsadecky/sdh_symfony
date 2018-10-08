<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\{Constraint, ConstraintValidator, Exception\UnexpectedTypeException};

/**
 * Class ZipCodeValidator
 * @package App\Validator\Constraints
 */
class ZipCodeValidator extends ConstraintValidator
{
    private const CODE_INVALID = 'INVALID ZIP CODE';

    /**
     * {@inheritdoc}
     */
    public function validate($value, Constraint $constraint):void
    {
        if (!$constraint instanceof ZipCode) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\ZipCode');
        }

        if(null === $value || '' === $value) {
            return;
        }

        if(!preg_match('/^\d{3}\C?\d{2}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $this->formatValue($value))
                ->setInvalidValue($value)
                ->setCode(self::CODE_INVALID)
                ->addViolation();
        }
    }
}
