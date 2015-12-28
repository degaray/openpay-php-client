<?php

namespace Openpay\Client\Validator;

use Openpay\Client\Exception\OpenpayException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 23/12/15
 * Time: 07:26 PM
 *
 * Class OpenpayCustomerValidator
 * @package Openpay\Client\Validator
 */
class OpenpayCustomerValidator
{
    /**
     * @param array $parameters
     * @return mixed
     */
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'name' => [
                new Assert\Length(['min' => 2]),
                new Assert\Required(),
            ],
            'last_name' => new Assert\Length(['min' => 2]),
            'email' => [
                new Assert\Email(),
                new Assert\Required(),
            ],
            'id' => new Assert\Optional(),
            'requires_account' => new Assert\Optional(),
            'phone_number' => new Assert\Length(['min' => 10, 'max' => 10]),
            'external_id' => new Assert\Optional(),
            'status' => new Assert\Optional(),
            'balance' => new Assert\Optional(),
            'address' => new Assert\Optional(),
            'clabe' => new Assert\Optional(),
        ]);

        if (isset($parameters['address'])) {
            $addressValidator = new OpenpayAddressValidator();
            $addressViolations = $addressValidator->validate($parameters['address']);
        }
        $customerViolations = $validator->validate($parameters, $constraints);

        if (isset($addressViolations)) {
            $customerViolations->addAll($addressViolations);
        }

        return $customerViolations;
    }
}
