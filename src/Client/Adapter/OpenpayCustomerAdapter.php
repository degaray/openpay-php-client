<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 18/12/15
 * Time: 11:08 AM
 */

namespace Openpay\Client\Adapter;

use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayCustomerMapper;
use Openpay\Client\Type\OpenpayCustomerType;
use Openpay\Client\Validator\OpenpayCustomerValidator;

/**
 * Class OpenpayCustomerAdapter
 * @package Openpay\Client\Adapter
 */
class OpenpayCustomerAdapter extends OpenpayAdapterAbstract
{
    /**
     * @var string
     */
    protected $customerId;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var OpenpayCustomerMapper
     */
    protected $customerMapper;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var OpenpayCustomerValidator
     */
    protected $customerValidator;

    /**
     * @var OpenpayCustomerType
     */
    protected $customerType;

    /**
     * OpenpayCustomerAdapter constructor.
     * @param OpenpayCustomerMapper $customerMapper
     * @param OpenpayCustomerType $customerType
     * @param ClientInterface $client
     * @param OpenpayCustomerValidator $customerValidator
     * @param array $config
     */
    public function __construct(
        OpenpayCustomerMapper $customerMapper,
        OpenpayCustomerType $customerType,
        ClientInterface $client,
        OpenpayCustomerValidator $customerValidator,
        array $config
    ) {
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->customerMapper = $customerMapper;
        $this->customerType = $customerType;
        $this->customerValidator = $customerValidator;
        $this->options = $this->getHeaderOptions($this->apiKey);

        parent::__construct($client);
    }

    /**
     * @param $customerId
     * @return OpenpayCustomerType
     * @throws OpenpayException
     */
    public function get($customerId)
    {
        if ($customerId == null) {
            throw new OpenpayException('Customer Id is not set', self::BAD_REQUEST_STATUS_CODE);
        }

        $relativeUrl = $this->merchantId . '/' . self::CUSTOMERS_ENDPOINT . '/' . $customerId;

        $responseArray = $this->callOpenpayClient($relativeUrl, $this->options);
        $customer = $this->customerMapper->create($responseArray);

        return $customer;
    }

    /**
     * @param array $parameters
     * @return OpenpayCustomerType
     * @throws OpenpayException
     */
    public function store(array $parameters)
    {
        $violations = $this->customerValidator->validate($parameters);

        if ($violations->count()>0) {
            throw new OpenpayException($violations->__toString(), 400);
        }

        $relativeUrl = $this->merchantId . '/' . self::CUSTOMERS_ENDPOINT;

        $options = $this->options;
        $options['json'] = $parameters;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);

        $customer = $this->customerMapper->create($response);

        return $customer;
    }

    /**
     * @return OpenpayCustomerType[]
     * @throws OpenpayException
     */
    public function getList()
    {
        $relativeUrl = $this->merchantId . '/' . self::CUSTOMERS_ENDPOINT;

        $responseArray = $this->callOpenpayClient($relativeUrl, $this->options);

        $customers = [];
        foreach ($responseArray as $customerReponse) {
            $customer = $this->customerMapper->create($customerReponse);
            $customers[] = $customer;
        }

        return $customers;
    }
}
