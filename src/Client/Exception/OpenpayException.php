<?php

namespace Openpay\Client\Exception;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 18/12/15
 * Time: 12:49 PM
 *
 * Class OpenpayException
 * @package Openpay\Client\Exception
 */
class OpenpayException extends \Exception
{
    /**
     * @var int
     */
    protected $errorCode;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $http_code;

    /**
     * @var string
     */
    protected $request_id;

    /**
     * @var string
     */
    protected $fraud_rules;

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
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
    public function getHttpCode()
    {
        return $this->http_code;
    }

    /**
     * @param string $http_code
     */
    public function setHttpCode($http_code)
    {
        $this->http_code = $http_code;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->request_id;
    }

    /**
     * @param string $request_id
     */
    public function setRequestId($request_id)
    {
        $this->request_id = $request_id;
    }

    /**
     * @return string
     */
    public function getFraudRules()
    {
        return $this->fraud_rules;
    }

    /**
     * @param string $fraud_rules
     */
    public function setFraudRules($fraud_rules)
    {
        $this->fraud_rules = $fraud_rules;
    }
}
