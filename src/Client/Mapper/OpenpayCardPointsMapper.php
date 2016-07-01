<?php

namespace Openpay\Client\Mapper;

use Openpay\Client\Type\OpenpayCardPointsType;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 05:43 PM
 *
 * Class OpenpayCardPointsMapper
 * @package Openpay\Client\Mapper
 */
class OpenpayCardPointsMapper
{
    /**
     * @param array $data
     * @param OpenpayCardPointsType|null $object
     * @return OpenpayCardPointsType
     */
    public function create(array $data, OpenpayCardPointsType $object = null)
    {
        if (is_null($object)) {
            $object = new OpenpayCardPointsType();
        }
        $newInstance = clone $object;
        $object = $this->populate($newInstance, $data);

        return $object;
    }

    /**
     * @param OpenpayCardPointsType $object
     * @param array $data
     * @return OpenpayCardPointsType
     */
    public function populate(OpenpayCardPointsType $object, array $data)
    {
        if (isset($data['used'])) {
            $object->setUsed($data['used']);
        }
        if (isset($data['remaining'])) {
            $object->setRemaining($data['remaining']);
        }
        if (isset($data['amount'])) {
            $object->setUsed($data['amount']);
        }
        if (isset($data['caption'])) {
            $object->setUsed($data['caption']);
        }

        return $object;
    }
}
