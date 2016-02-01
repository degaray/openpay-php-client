<?php

namespace Openpay\Client\Type;

/**
 *
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 12:14 PM
 *
 * Class OpenpayTransactionType
 * @package Openpay\Client\Type
 */
class OpenpayTransactionType
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $authorization;

    /**
     * @var string
     */
    protected $transaction_type;

    /**
     * @var string
     */
    protected $operation_type;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var \Datetime
     */
    protected $creation_date;

    /**
     * @var string
     */
    protected $order_id;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var double
     */
    protected $amount;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $error_message;

    /**
     * @var string
     */
    protected $customer_id;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var OpenpayBankAccountType
     */
    protected $bank_account;

    /**
     * @var OpenpayCardType
     */
    protected $card;

    /**
     * @var OpenpayCardPointsType
     */
    protected $card_points;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAuthorization()
    {
        return $this->authorization;
    }

    /**
     * @param string $authorization
     */
    public function setAuthorization($authorization)
    {
        $this->authorization = $authorization;
    }

    /**
     * @return string
     */
    public function getTransactionType()
    {
        return $this->transaction_type;
    }

    /**
     * @param string $transaction_type
     */
    public function setTransactionType($transaction_type)
    {
        $this->transaction_type = $transaction_type;
    }

    /**
     * @return string
     */
    public function getOperationType()
    {
        return $this->operation_type;
    }

    /**
     * @param string $operation_type
     */
    public function setOperationType($operation_type)
    {
        $this->operation_type = $operation_type;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return \Datetime
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * @param \Datetime $creation_date
     */
    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param string $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->error_message;
    }

    /**
     * @param string $error_message
     */
    public function setErrorMessage($error_message)
    {
        $this->error_message = $error_message;
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
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return OpenpayBankAccountType
     */
    public function getBankAccount()
    {
        return $this->bank_account;
    }

    /**
     * @param OpenpayBankAccountType $bank_account
     */
    public function setBankAccount($bank_account)
    {
        $this->bank_account = $bank_account;
    }

    /**
     * @return OpenpayCardType
     */
    public function getCard()
    {
        return $this->card;
    }

    /**
     * @param OpenpayCardType $card
     */
    public function setCard($card)
    {
        $this->card = $card;
    }

    /**
     * @return OpenpayCardPointsType
     */
    public function getCardPoints()
    {
        return $this->card_points;
    }

    /**
     * @param OpenpayCardPointsType $card_points
     */
    public function setCardPoints($card_points)
    {
        $this->card_points = $card_points;
    }
}
