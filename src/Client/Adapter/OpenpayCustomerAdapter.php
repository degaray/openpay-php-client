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

class OpenpayCustomerAdapter
{
    const GET_METHOD = 'GET';
    const JSON_DECODE_AS_ARRAY = true;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var string
     */
    protected $customerId;

    /**
     * OpenpayCustomerAdapter constructor.
     * @param OpenpayCustomerMapper $customerMapper
     * @param OpenpayCustomerType $customerType
     * @param ClientInterface $client
     * @param $config
     */
    public function __construct(
        OpenpayCustomerMapper $customerMapper,
        OpenpayCustomerType $customerType,
        ClientInterface $client,
        $config
    ) {
        $this->client = $client;
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->customerMapper = $customerMapper;
        $this->customerType = $customerType;
        $this->options = $this->getOptions($this->apiKey);
    }

    /**
     * @param $apiKey
     * @return array
     */
    protected function getOptions($apiKey)
    {
         return [
            'headers' => [
                'Content-type' => 'application/json',
                'Accept'     => 'application/json',
            ],
            'auth' => [
                $apiKey,
                ''
            ]
        ];
    }

    /**
     * @param $customerId
     * @return OpenpayCustomerType
     * @throws OpenpayException
     */
    public function get($customerId)
    {
        if ($customerId == null) {
            throw new OpenpayException('Customer Id was is not set');
        }

        $relativeUrl = $this->merchantId . '/customers/' . $customerId;
        try {
            $responseArray = $this->callOpenpayClient($relativeUrl, $this->options);
        } catch (\Exception $e) {
            throw new OpenpayException($e->getMessage());
        }

        $customer = $this->customerMapper->create($responseArray);

        return $customer;
    }

    /**
     * @return OpenpayCustomerType[]
     * @throws OpenpayException
     */
    public function getList()
    {
        $relativeUrl = $this->merchantId . '/customers';
        try {
            $responseArray = $this->callOpenpayClient($relativeUrl, $this->options);
        } catch (\Exception $e) {
            throw new OpenpayException($e->getMessage());
        }

        $customers = [];
        foreach ($responseArray as $customerReponse)
        {
            $customer = $this->customerMapper->create($customerReponse);
            $customers[] = $customer;
        }

        return $customers;
    }

    /**
     * @param $url
     * @param $options
     * @param string $method
     * @return mixed
     * @throws OpenpayException
     */
    protected function callOpenpayClient($url, $options, $method = self::GET_METHOD)
    {
        try {
            $rawResponse = $this->client->request($method, $url, $options);
        } catch (\Exception $e) {
            throw new OpenpayException($e->getMessage());
        }
        $responseContent = $rawResponse->getBody()->getContents();
        $responseArray = json_decode($responseContent, self::JSON_DECODE_AS_ARRAY);

        return $responseArray;
    }
}