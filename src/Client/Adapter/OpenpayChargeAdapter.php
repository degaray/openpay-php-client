<?php

namespace Openpay\Client\Adapter;

use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayExceptionMapper;
use Openpay\Client\Mapper\OpenpayTransactionMapper;
use Openpay\Client\Validator\OpenpayChargeValidator;


/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 10:52 AM
 *
 * Class OpenpayChargeAdapter
 * @package Openpay\Client\Adapter
 */
class OpenpayChargeAdapter extends OpenpayAdapterAbstract implements OpenpayChargeAdapterInterface
{
    /**
     * @var OpenpayChargeValidator
     */
    protected $chargeValidator;

    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var OpenpayTransactionMapper
     */
    protected $transactionMapper;

    /**
     * @var array
     */
    protected $options;

    public function __construct(
        ClientInterface $client,
        OpenpayExceptionMapper $exceptionMapper,
        OpenpayChargeValidator $validator,
        OpenpayTransactionMapper $transactionMapper,
        array $config = []
    ) {
        parent::__construct($client, $exceptionMapper);
        $this->chargeValidator = $validator;
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->transactionMapper = $transactionMapper;
        $this->options = $this->getHeaderOptions($this->apiKey);
    }

    /**
     * @param $customerId
     * @param $parameters
     * @return \Openpay\Client\Type\OpenpayTransactionType
     * @throws OpenpayException
     */
    public function chargeCustomerCard($customerId, $parameters)
    {
        $violations = $this->chargeValidator->validate($parameters);

        if ($violations->count() > 0) {
            $openpayException = new OpenpayException($violations->__toString(), self::BAD_REQUEST_STATUS_CODE);
            $openpayException->setErrorCode(self::OPENPAY_BAD_REQUEST_CODE);
            $openpayException->setDescription($violations->__toString());
            throw $openpayException;
        }

        $relativeUrl = $this->merchantId .
            '/' . self::CUSTOMERS_ENDPOINT .
            '/' . $customerId .
            '/' . self::CHARGES_ENDPOINT;

        $options = $this->options;
        $options['json'] = $parameters;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);

        $transaction = $this->transactionMapper->create($response);

        return $transaction;
    }
}
