<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 28/12/15
 * Time: 01:28 PM
 */

namespace Openpay\Client\Validator;

use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

class OpenpayCardTokenValidator
{
    public function validate(array $parameters)
    {
        $validator = Validation::createValidator();

        $constraints = new Collection([
            'token_id' => new Assert\Required(),
            'device_session_id' => new Assert\Optional(),
        ]);

        $violations = $validator->validate($parameters, $constraints);

        return $violations;
    }
}