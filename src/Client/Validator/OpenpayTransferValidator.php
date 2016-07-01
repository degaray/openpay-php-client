<?php

namespace Openpay\Client\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;

class OpenpayTransferValidator
{
    public function validate($sender_id, array $parameters)
    {
        $parameters['sender_id'] = $sender_id;

        $validator = Validation::createValidator();

        $constraints = new Collection([
            'sender_id' => [
                new Assert\Required(),
                new Assert\Length(['max' => 45]),
            ],
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
