<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 11:02 AM
 */

namespace Openpay\Client\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

class OpenpayChargeRefundValidator
{
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'amount' => [
                new Assert\GreaterThan(0),
                new Assert\Required()
            ],
            'description' => [
                new Assert\Length(['max' => 250]),
                new Assert\Required()
            ],
        ]);

        $violations = $validator->validate($parameters, $constraints);

        return $violations;
    }
}
