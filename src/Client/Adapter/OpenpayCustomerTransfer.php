<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 6/29/16
 * Time: 12:29 PM
 */

namespace Openpay\Client\Adapter;


use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayExceptionMapper;
use Openpay\Client\Mapper\OpenpayTransactionMapper;
use Openpay\Client\Validator\OpenpayTransferValidator;

class OpenpayCustomerTransfer extends OpenpayAdapterAbstract implements OpenpayCustomerTransferInterface
{
    /**
     * @var OpenpayTransferValidator
     */
    protected $transferValidator;

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

    /**
     * OpenpayCustomerTransaction constructor.
     * @param ClientInterface $client
     * @param OpenpayExceptionMapper $exceptionMapper
     * @param OpenpayTransferValidator $validator
     * @param OpenpayTransactionMapper $transactionMapper
     * @param array $config
     */
    public function __construct(
        ClientInterface $client,
        OpenpayExceptionMapper $exceptionMapper,
        OpenpayTransferValidator $validator,
        OpenpayTransactionMapper $transactionMapper,
        array $config = []
    ) {
        parent::__construct($client, $exceptionMapper);
        $this->transferValidator = $validator;
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->transactionMapper = $transactionMapper;
        $this->options = $this->getHeaderOptions($this->apiKey);
    }

    /**
     * @param int $senderId
     * @param array $parameters
     * @return \Openpay\Client\Type\OpenpayTransactionType
     * @throws OpenpayException
     */
    public function transfer($senderId, $parameters)
    {
        $violations = $this->transferValidator->validate($senderId, $parameters);

        if ($violations->count() > 0) {
            $openpayException = new OpenpayException($violations->__toString(), self::BAD_REQUEST_STATUS_CODE);
            $openpayException->setErrorCode(self::OPENPAY_BAD_REQUEST_CODE);
            $openpayException->setDescription($violations->__toString());
            throw $openpayException;
        }

        $relativeUrl = $this->merchantId .
            '/' . self::CUSTOMERS_ENDPOINT .
            '/' . $senderId .
            '/' . self::TRANSFERS_ENDPOINT;

        $options = $this->options;
        $options['json'] = $parameters;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);

        $transaction = $this->transactionMapper->create($response);

        return $transaction;
    }
}
