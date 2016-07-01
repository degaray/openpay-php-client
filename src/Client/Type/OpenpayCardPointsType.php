<?php

namespace Openpay\Client\Type;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 12:51 PM
 *
 * Class OpenpayCardPointsType
 * @package Openpay\Client\Type
 */
class OpenpayCardPointsType
{
    /**
     * @var int
     */
    protected $used;

    /**
     * @var int
     */
    protected $remaining;

    /**
     * @var double
     */
    protected $amount;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @return int
     */
    public function getUsed()
    {
        return $this->used;
    }

    /**
     * @param int $used
     */
    public function setUsed($used)
    {
        $this->used = $used;
    }

    /**
     * @return int
     */
    public function getRemaining()
    {
        return $this->remaining;
    }

    /**
     * @param int $remaining
     */
    public function setRemaining($remaining)
    {
        $this->remaining = $remaining;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }
}
