<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 10:16 AM
 */

namespace Openpay\Client\Adapter;
use GuzzleHttp\ClientInterface;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayCardMapper;
use Openpay\Client\Validator\OpenpayCardTokenValidator;

/**
 * Class OpenpayCardAdapter
 * @package Openpay\Client\Adapter
 */
class OpenpayCardAdapter extends OpenpayAdapterAbstract
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
     * @var OpenpayCardMapper
     */
    protected $cardMapper;

    /**
     * @var array
     */
    protected $options;

    /**
     * OpenpayCardAdapter constructor.
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
     * @param $customerId
     * @param array $findDataRequest
     * @return array
     * @throws OpenpayException
     */
    public function getList($customerId, array $findDataRequest = [])
    {
        $relativeUrl = $this->merchantId .
            '/' .
            self::CUSTOMERS_ENDPOINT .
            '/' .
            $customerId .
            '/' .
            self::CARDS_ENDPOINT;

        $responseArray = $this->callOpenpayClient($relativeUrl, $this->options);

        $cards = [];
        foreach ($responseArray as $cardsReponse) {
            $card = $this->cardMapper->create($cardsReponse);
            $cards[] = $card;
        }

        return $cards;
    }

    /**
     * @param $customerId
     * @param array $parameters
     * @return \Openpay\Client\Type\OpenpayCardType
     * @throws OpenpayException
     */
    public function store($customerId, array $parameters)
    {
        $validator = new OpenpayCardTokenValidator();
        $violations = $validator->validate($parameters);

        if ($violations->count()>0) {
            throw new OpenpayException($violations->__toString(), 400);
        }

        // POST https://sandbox-api.openpay.mx/v1/{MERCHANT_ID}/customers/{CUSTOMER_ID}/cards
        $relativeUrl = $this->merchantId .
            '/' .
            self::CUSTOMERS_ENDPOINT .
            '/' .
            $customerId .
            '/' .
            self::CARDS_ENDPOINT;

        $options = $this->options;
        $body = [
            'token_id' => $parameters['token_id'],
            'device_session_id' => (isset($parameters['device_session_id']))? $parameters['device_session_id'] : null,
        ];
        $options['json'] = $body;

        $response = $this->callOpenpayClient($relativeUrl, $options, self::POST_METHOD);
        $card = $this->cardMapper->create($response);

        return $card;
    }

    /**
     * @param $customerId string
     * @param $cardId string
     * @return bool
     * @throws OpenpayException
     */
    public function delete($customerId, $cardId)
    {
        $relativeUrl = $this->merchantId .
            '/' .
            self::CUSTOMERS_ENDPOINT .
            '/' .
            $customerId .
            '/' .
            self::CARDS_ENDPOINT .
            '/' .
            $cardId;

        $this->callOpenpayClient($relativeUrl, $this->options, self::DELETE_METHOD);

        return true;
    }
}
