<?php

namespace Openpay\Client\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 23/12/15
 * Time: 08:49 PM
 *
 * Class OpenpayAddressValidator
 * @package Openpay\Client\Validator
 */
class OpenpayAddressValidator
{
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'line1' => new Assert\Required(),
            'line2' => new Assert\Optional(),
            'line3' => new Assert\Optional(),
            'postal_code' => new Assert\Length(['min' => 5]),
            'state' => [
                new Assert\Length(['min' => 2]),
                new Assert\Required()
            ],
            'city' => new Assert\Required(),
            'country_code' => [
                new Assert\Length(['min' => 2, 'max' => 2]),
                new Assert\Required(),
            ],
        ]);

        $violations = $validator->validate($parameters, $constraints);

        return $violations;
    }
}
