<?php

namespace Openpay\Client\Type;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 10:28 AM
 *
 * Class OpenpayCustomerType
 * @package Openpay\Client\Type
 */
class OpenpayCustomerType extends TypeAbstract implements \ArrayAccess
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
    protected $name;

    /**
     * @var string
     */
    protected $last_name;

    /**
     * @var  string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone_number;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var double
     */
    protected $balance;

    /**
     * @var string
     */
    protected $clabe;

    /**
     * @var OpenpayAddressType
     */
    protected $address;

    /**
     * @var OpenpayStoreType
     */
    protected $store;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getClabe()
    {
        return $this->clabe;
    }

    /**
     * @param string $clabe
     */
    public function setClabe($clabe)
    {
        $this->clabe = $clabe;
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
    public function setAddress(OpenpayAddressType $address)
    {
        $this->address = $address;
    }

    /**
     * @return OpenpayStoreType
     */
    public function getStore()
    {
        return $this->store;
    }

    /**
     * @param OpenpayStoreType $store
     */
    public function setStore(OpenpayStoreType $store)
    {
        $this->store = $store;
    }
}
