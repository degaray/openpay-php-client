<?php

namespace Openpay\Client\Type;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 2/01/16
 * Time: 10:59 AM
 *
 * Class TypeAbstract
 * @package Openpay\Client\Type
 */
class TypeAbstract
{
    /**
     * @param $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        if (isset($this->$offset)){
            return true;
        }

        return false;
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * @param $offset
     * @param $value
     * @return mixed
     */
    public function offsetSet($offset, $value)
    {
        return $this->$offset = $value;
    }

    /**
     * @param $offset
     * @return null
     */
    public function offsetUnset($offset)
    {
        return $this->$offset = null;
    }
}
