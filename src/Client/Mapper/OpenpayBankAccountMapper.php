<?php

namespace Openpay\Client\Mapper;

use Openpay\Client\Type\OpenpayBankAccountType;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 01:44 PM
 *
 * Class OpenpayBankAccountMapper
 * @package Openpay\Client\Mapper
 */
class OpenpayBankAccountMapper
{
    public function create(array $data, OpenpayBankAccountType $object = null)
    {
        if (is_null($object)) {
            $object = new OpenpayBankAccountType();
        }
        $newInstance = clone $object;
        $object = $this->populate($newInstance, $data);

        return $object;
    }

    public function populate(OpenpayBankAccountType $object, array $data)
    {
        if (isset($data['alias'])) {
            $object->setAlias($data['alias']);
        }

        if (isset($data['bank_name'])) {
            $object->setBankName($data['bank_name']);
        }

        if (isset($data['creation_date'])) {
            $object->setCreationDate($data['creation_date']);
        }

        if (isset($data['clabe'])) {
            $object->setClabe($data['clabe']);
        }

        if (isset($data['holder_name'])) {
            $object->setHolderName($data['holder_name']);
        }

        if (isset($data['bank_code'])) {
            $object->setBankCode($data['bank_code']);
        }

        return $object;
    }
}
