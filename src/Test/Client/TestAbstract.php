<?php

namespace Openpay\Test\Client;
use GuzzleHttp\Client;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 21/12/15
 * Time: 05:37 PM
 *
 * Class TestAbstract
 * @package Openpay\Test\Client
 */
class TestAbstract extends \PHPUnit_Framework_TestCase
{
    const SANDBOX_BASE_URL = 'https://sandbox-api.openpay.mx/v1/';
    const PRODUCTION_BASE_URL = 'https://api.openpay.mx/v1/';

    /**
     * @param array $params
     * @return array
     */
    public function getParameters(array $params)
    {
        global $argv;

        $arguments = [];
        foreach ($argv as $arg)
        {
            $argument = explode("=", $arg);
            if (in_array($argument[0], $params)) {
                $arguments[$argument[0]] = $argument[1];
            }
        }

        return $arguments;
    }

    /**
     * @param $parameters
     * @return Client
     */
    public function getRealClient($parameters)
    {
        $baseUrl = $this->getBaseUrl($parameters);

        $client = new Client(['base_uri' => $baseUrl]);

        return $client;
    }

    /**
     * @param array $parameters
     * @return string
     */
    public function getBaseUrl(array $parameters)
    {
        $useSandbox = false;
        if (!isset($parameters['sandbox'])) {
            $useSandbox = true;
        }

        if ($parameters['sandbox'] == true) {
            $useSandbox = true;
        }

        $baseUrl = ($useSandbox) ? self::SANDBOX_BASE_URL : self::PRODUCTION_BASE_URL;
        return $baseUrl;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockBuilder
     */
    public function getMockClient()
    {
        $mockClient = $this->getMockBuilder('GuzzleHttp\Client');

        return $mockClient;
    }
}