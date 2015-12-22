<?php

namespace Openpay\Client\Mapper;

use Openpay\Client\Type\OpenpayAddressType;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 11:09 AM
 *
 * Class OpenpayAddressMapper
 * @package Openpay\Client\Mapper
 */
class OpenpayAddressMapper
{
    /**
     * @param array $data
     * @param OpenpayAddressType|null $object
     * @return OpenpayAddressType
     */
    public function create(array $data, OpenpayAddressType $object = null)
    {
        if (is_null($object)) {
            $object = new OpenpayAddressType();
        }
        $object = $this->populate($object, $data);

        return $object;
    }

    /**
     * @param OpenpayAddressType $object
     * @param array $data
     * @return OpenpayAddressType
     */
    public function populate(OpenpayAddressType $object, array $data)
    {
        $object->setCity($data['city']);
        $object->setCountryCode($data['country_code']);
        $object->setLine1($data['line1']);
        $object->setLine2($data['line2']);
        $object->setLine3($data['line3']);
        $object->setPostalCode($data['postal_code']);
        $object->setState($data['state']);

        return $object;
    }
}
