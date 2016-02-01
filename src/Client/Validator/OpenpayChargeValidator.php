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

class OpenpayChargeValidator
{
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'method' => new Assert\Required(),
            'source_id' => [
                new Assert\Required(),
                new Assert\Length(['max' => 45])
            ],
            'amount' => [
                new Assert\GreaterThan(0),
                new Assert\Required()
            ],
            'currency' => [
                new Assert\Length(3),
                new Assert\Optional(),
            ],
            'description' => [
                new Assert\Length(['max' => 250]),
                new Assert\Required()
            ],
            'order_id' => [
                new Assert\Length(['max' => 100]),
                new Assert\Optional(),
            ],
            'device_session_id' => [
                new Assert\Length(['max' => 255]),
                new Assert\Optional(),
            ],
            'capture' => new Assert\Optional(),
            'customer' => new Assert\Optional(),
            'metadata' => new Assert\Optional(),
            'use_card_points' => new Assert\Optional()
        ]);

        $violations = $validator->validate($parameters, $constraints);

        return $violations;
    }
}