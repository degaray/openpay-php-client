<?php

namespace Openpay\Client\Adapter;
use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;


/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 22/12/15
 * Time: 02:53 PM
 *
 * Class OpenpayAdapterAbstract
 * @package Openpay\Client\Adapter
 */
class OpenpayAdapterAbstract
{
    const GET_METHOD = 'GET';
    const POST_METHOD = 'POST';
    const DELETE_METHOD = 'DELETE';
    const BAD_REQUEST_STATUS_CODE = '400';
    const JSON_DECODE_AS_ARRAY = true;
    const CUSTOMERS_ENDPOINT = 'customers';
    const CARDS_ENDPOINT = 'cards';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * OpenpayAdapterAbstract constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param $apiKey
     * @return array
     */
    protected function getHeaderOptions($apiKey)
    {
        $options = [
            'headers' => [
                'Content-type' => 'application/json',
                'Accept'     => 'application/json',
            ],
            'auth' => [
                $apiKey,
                ''
            ]
        ];

        return $options;
    }

    /**
     * @param string $url
     * @param array $options
     * @param string $method
     * @return array
     * @throws OpenpayException
     */
    protected function callOpenpayClient($url, array $options, $method = self::GET_METHOD)
    {
        try {
            $rawResponse = $this->client->request($method, $url, $options);
        } catch (\Exception $e) {
            throw new OpenpayException($e->getMessage(), $e->getCode(), $e);
        }
        $responseContent = $rawResponse->getBody()->getContents();
        $responseArray = json_decode($responseContent, self::JSON_DECODE_AS_ARRAY);

        return $responseArray;
    }
}