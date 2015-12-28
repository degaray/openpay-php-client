<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 28/12/15
 * Time: 01:40 PM
 */

namespace Openpay\Test\Client\Adapter;

use GuzzleHttp\ClientInterface;
use Openpay\Client\Adapter\OpenpayAdapterAbstract;
use Openpay\Client\Mapper\OpenpayCardMapper;

class OpenpayCardTokenAdapter extends OpenpayAdapterAbstract
{
    /**
     * @var string
     */
    protected $merchantId;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var OpenpayCardMapper
     */
    protected $cardMapper;

    /**
     * OpenpayCardTokenAdapter constructor.
     * @param ClientInterface $client
     * @param OpenpayCardMapper $cardMapper
     * @param array $config
     */
    public function __construct(
        ClientInterface $client,
        OpenpayCardMapper $cardMapper,
        array $config
    ) {
        $this->merchantId = $config['merchantId'];
        $this->apiKey = $config['apiKey'];
        $this->options = $this->getHeaderOptions($this->apiKey);
        $this->cardMapper = $cardMapper;

        parent::__construct($client);
    }

    /**
     * WARNING, this class is only used for testing purposes. No card information should be sent to the server directly
     * as it will represent a serious security concern. Do not use this function in a production environment unless you
     * know very well what you are doing
     *
     * @param array $parameters
     * @return array
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    public function store(array $parameters)
    {
        /* TODO validate parameters to be compatible */

        // https://sandbox-api.openpay.mx/v1/mzdtln0bmtms6o3kck8f/tokens
        $relativeUrl = $this->merchantId .
            '/' .
            self::TOKENS_ENDPOINT;

        $options = $this->options;

        $options['json'] = $parameters;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);
        $card = $this->cardMapper->create($response['card']);

        $token = [
            'token_id' => $response['id'],
            'card' => $card,
        ];

        return $token;
    }
}
