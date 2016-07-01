<?php

namespace Openpay\Client\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 10/02/16
 * Time: 03:39 PM
 *
 * Class OpenpayFeeValidator
 * @package Openpay\Client\Validator
 */
class OpenpayFeeValidator
{
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'customer_id' => [
                new Assert\Required(),
                new Assert\Length(['max' => 45]),
            ],
            'amount' => [
                new Assert\GreaterThan(0),
                new Assert\Required(),
            ],
            'description' => [
                new Assert\Length(['max' => 250]),
                new Assert\Required(),
            ],
            'order_id' => [
                new Assert\Length(['max' => 100]),
                new Assert\Optional(),
            ],
        ]);

        $violations = $validator->validate($parameters, $constraints);

        return $violations;
    }
}
