<?php

namespace Openpay\Client\Type;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 10:19 AM
 *
 * Class OpenpayCardType
 * @package Openpay\Client\Type
 */
class OpenpayCardType
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \DateTime
     */
    protected $creation_date;

    /**
     * @var string
     */
    protected $holder_name;

    /**
     * @var string
     */
    protected $card_number;

    /**
     * @var string
     */
    protected $cvv2;

    /**
     * @var int
     */
    protected $expiration_month;

    /**
     * @var int
     */
    protected $expiration_year;

    /**
     * @var string
     */
    protected $address;

    /**
     * @var bool
     */
    protected $allows_charges;

    /**
     * @var bool
     */
    protected $allows_payouts;

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $bank_name;

    /**
     * @var string
     */
    protected $bank_code;

    /**
     * @var string
     */
    protected $customer_id;

    /**
     * @var bool
     */
    protected $points_card;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param \DateTime $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return string
     */
    public function getHolderName()
    {
        return $this->holder_name;
    }

    /**
     * @param string $holder_name
     */
    public function setHolderName($holder_name)
    {
        $this->holder_name = $holder_name;
    }

    /**
     * @return string
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * @param string $card_number
     */
    public function setCardNumber($card_number)
    {
        $this->card_number = $card_number;
    }

    /**
     * @return string
     */
    public function getCvv2()
    {
        return $this->cvv2;
    }

    /**
     * @param string $cvv2
     */
    public function setCvv2($cvv2)
    {
        $this->cvv2 = $cvv2;
    }

    /**
     * @return int
     */
    public function getExpirationMonth()
    {
        return $this->expiration_month;
    }

    /**
     * @param int $expiration_month
     */
    public function setExpirationMonth($expiration_month)
    {
        $this->expiration_month = $expiration_month;
    }

    /**
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->expiration_year;
    }

    /**
     * @param int $expiration_year
     */
    public function setExpirationYear($expiration_year)
    {
        $this->expiration_year = $expiration_year;
    }

    /**
     * @return OpenpayAddressType
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param OpenpayAddressType $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return boolean
     */
    public function isAllowsCharges()
    {
        return $this->allows_charges;
    }

    /**
     * @param boolean $allows_charges
     */
    public function setAllowsCharges($allows_charges)
    {
        $this->allows_charges = $allows_charges;
    }

    /**
     * @return bool
     */
    public function isAllowsPayouts()
    {
        return $this->allows_payouts;
    }

    /**
     * @param bool $allows_payouts
     */
    public function setAllowsPayouts($allows_payouts)
    {
        $this->allows_payouts = $allows_payouts;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getBankName()
    {
        return $this->bank_name;
    }

    /**
     * @param string $bank_name
     */
    public function setBankName($bank_name)
    {
        $this->bank_name = $bank_name;
    }

    /**
     * @return string
     */
    public function getBankCode()
    {
        return $this->bank_code;
    }

    /**
     * @param string $bank_code
     */
    public function setBankCode($bank_code)
    {
        $this->bank_code = $bank_code;
    }

    /**
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param string $customer_id
     */
    public function setCustomerId($customer_id)
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return boolean
     */
    public function isPointsCard()
    {
        return $this->points_card;
    }

    /**
     * @param boolean $points_card
     */
    public function setPointsCard($points_card)
    {
        $this->points_card = $points_card;
    }
}