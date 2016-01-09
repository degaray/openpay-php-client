<?php

namespace Openpay\Client\Adapter;
use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Exception\OpenpayExceptionsDictionary;
use Openpay\Client\Mapper\OpenpayExceptionMapper;


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
    const ENTITY_DELETED_SUCCESSFULLY = true;
    const JSON_DECODE_AS_ARRAY = true;
    const CUSTOMERS_ENDPOINT = 'customers';
    const CARDS_ENDPOINT = 'cards';
    const TOKENS_ENDPOINT = 'tokens';
    const EXCEPTION_RESPONSE_JSON_INDEX = 1;
    const JSON_DECODE_TO_ARRAY = true;
    const DESCRIPTION_DICTIONARY_KEY = 'description';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var OpenpayExceptionMapper
     */
    protected $exceptionMapper;

    /**
     * OpenpayAdapterAbstract constructor.
     * @param ClientInterface $client
     * @param OpenpayExceptionMapper $exceptionMapper
     */
    public function __construct(ClientInterface $client, OpenpayExceptionMapper $exceptionMapper)
    {
        $this->client = $client;
        $this->exceptionMapper = $exceptionMapper;
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
            $responseParts = explode("\n", $e->getMessage());
            $openpayException = new OpenpayException($responseParts[0], $e->getCode(), $e);

            $headers = $e->getResponse()->getHeaders();

            $values['error_code'] = isset($headers['OP-Error-Code'])? $headers['OP-Error-Code'][0] : null;
            $values['request_id'] = isset($headers['OpenPay-Request-ID'])? $headers['OpenPay-Request-ID'][0] : null;
            $dictionary = OpenpayExceptionsDictionary::get();

            if (isset($dictionary[$values['error_code']])) {
                $values['description'] = $dictionary[$values['error_code']][self::DESCRIPTION_DICTIONARY_KEY];
            }

            if (isset($responseParts[self::EXCEPTION_RESPONSE_JSON_INDEX])) {
                $responseObjectStr = $responseParts[self::EXCEPTION_RESPONSE_JSON_INDEX];
                $responseObject = json_decode($responseObjectStr, self::JSON_DECODE_TO_ARRAY);
                $values = array_merge($values, $responseObject);
                $openpayException = $this->exceptionMapper->create($values, $openpayException);
            }

            throw $openpayException;
        }
        $responseContent = $rawResponse->getBody()->getContents();
        $responseArray = json_decode($responseContent, self::JSON_DECODE_AS_ARRAY);

        return $responseArray;
    }
}