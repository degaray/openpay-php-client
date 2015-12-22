<?php

namespace Openpay\Client\Mapper;

use Openpay\Client\Type\OpenpayStoreType;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 11:00 AM
 *
 * Class OpenpayStoreMapper
 * @package Openpay\Client\Mapper
 */
class OpenpayStoreMapper
{
    /**
     * @param array $data
     * @param OpenpayStoreType|null $object
     * @return OpenpayStoreType
     */
    public function create(array $data, OpenpayStoreType $object = null)
    {
        if (is_null($object)) {
            $object = new OpenpayStoreType();
        }
        $object = $this->populate($object, $data);

        return $object;
    }

    /**
     * @param OpenpayStoreType $object
     * @param array $data
     * @return OpenpayStoreType
     */
    public function populate(OpenpayStoreType $object, array $data)
    {
        $object->setReference($data['reference']);
        $object->setBarcodeUrl($data['barcode_url']);

        return $object;
    }
}
