<?php

namespace Openpay\Client\Type;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 12:45 PM
 *
 * Class OpenpayBankAccountType
 * @package Openpay\Client\Type
 */
class OpenpayBankAccountType
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @var string
     */
    protected $bank_name;

    /**
     * @var \DateTime
     */
    protected $creation_date;

    /**
     * @var string
     */
    protected $clabe;

    /**
     * @var string
     */
    protected $holder_name;

    /**
     * @var string
     */
    protected $bank_code;

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
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
}
