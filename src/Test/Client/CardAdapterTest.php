<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 22/12/15
 * Time: 03:22 PM
 */

namespace Openpay\Test\Client;


use Openpay\Client\Adapter\OpenpayCardAdapter;
use Openpay\Client\Mapper\OpenpayAddressMapper;
use Openpay\Client\Mapper\OpenpayCardMapper;
use Openpay\Client\Type\OpenpayCardType;

class CardAdapterTest extends CustomerAdapterTest
{
    /**
     * @var OpenpayCardAdapter
     */
    protected $cardAdapter;

    /**
     *
     */
    public function setUp()
    {
        $this->setNewCardAdapter();
        parent::setUp();
    }

    /**
     *
     */
    protected function setNewCardAdapter()
    {
        $parametersNeeded = ['sandbox', 'merchantId', 'apiKey'];
        $parameters = $this->getParameters($parametersNeeded);

        $client = $this->getMockClient();
        $config = [
            'merchantId' => '',
            'apiKey' =>''
        ];
        if (isset($parameters['apiKey'])) {
            $client = $this->getRealClient($parameters);

            $config = [
                'merchantId' => $parameters['merchantId'],
                'apiKey' => $parameters['apiKey']
            ];
        }

        $cardType = new OpenpayCardType();
        $addressMapper = new OpenpayAddressMapper();
        $cardMapper = new OpenpayCardMapper($cardType, $addressMapper);

        $this->cardAdapter = new OpenpayCardAdapter($client, $cardMapper, $config);

    }

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    public function test_get_card_list()
    {
        $openpayCustomers = $this->adapter->getList();

        $testCustomerId = $openpayCustomers[count($openpayCustomers)-1]->getId();
        $openpayCards = $this->cardAdapter->getList($testCustomerId);

        $this->assertGreaterThan(0, count($openpayCards));
        $this->assertInstanceOf('Openpay\Client\Type\OpenpayCardType', $openpayCards[0]);
        $this->assertNotEmpty($openpayCards[0]->getId(), 'Id is not empty');
    }
}