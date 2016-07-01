<?php

namespace Openpay\Client\Adapter;

use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayExceptionMapper;
use Openpay\Client\Mapper\OpenpayTransactionMapper;
use Openpay\Client\Validator\OpenpayFeeValidator;


/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 10/02/16
 * Time: 15:35 AM
 *
 * Class OpenpayFeeAdapter
 * @package Openpay\Client\Adapter
 */
class OpenpayFeeAdapter extends OpenpayAdapterAbstract implements OpenpayFeeAdapterInterface
{
    /**
     * @var OpenpayFeeValidator
     */
    protected $feeValidator;

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
        OpenpayFeeValidator $validator,
        OpenpayTransactionMapper $transactionMapper,
        array $config = []
    ) {
        parent::__construct($client, $exceptionMapper);
        $this->feeValidator = $validator;
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->transactionMapper = $transactionMapper;
        $this->options = $this->getHeaderOptions($this->apiKey);
    }

    /**
     * @param $parameters
     * @return \Openpay\Client\Type\OpenpayTransactionType
     * @throws OpenpayException
     */
    public function chargeFee($parameters)
    {
        $violations = $this->feeValidator->validate($parameters);

        if ($violations->count() > 0) {
            $openpayException = new OpenpayException($violations->__toString(), self::BAD_REQUEST_STATUS_CODE);
            $openpayException->setErrorCode(self::OPENPAY_BAD_REQUEST_CODE);
            $openpayException->setDescription($violations->__toString());
            throw $openpayException;
        }

        $relativeUrl = $this->merchantId .
            '/' . self::FEES_ENDPOINT;

        $options = $this->options;
        $options['json'] = $parameters;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);

        $transaction = $this->transactionMapper->create($response);

        return $transaction;
    }
}
