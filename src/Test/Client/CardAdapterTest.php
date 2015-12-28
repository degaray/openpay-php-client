<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 22/12/15
 * Time: 03:22 PM
 */

namespace Openpay\Test\Client\Adapter;


use Openpay\Client\Adapter\OpenpayCardAdapter;
use Openpay\Client\Adapter\OpenpayCustomerAdapter;
use Openpay\Client\Mapper\OpenpayAddressMapper;
use Openpay\Client\Mapper\OpenpayCardMapper;
use Openpay\Client\Mapper\OpenpayCustomerMapper;
use Openpay\Client\Mapper\OpenpayStoreMapper;
use Openpay\Client\Type\OpenpayCardType;
use Openpay\Client\Type\OpenpayCustomerType;
use Openpay\Client\Validator\OpenpayCustomerValidator;
use Openpay\Test\Client\TestAbstract;

class CardAdapterTest extends TestAbstract
{
    /**
     * @var OpenpayCardAdapter
     */
    protected $cardAdapter;

    /**
     * @var OpenpayCustomerAdapter
     */
    protected $customerAdapter;

    /**
     * @var OpenpayCardTokenAdapter
     */
    protected $tokenAdapter;

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

        $this->tokenAdapter = new OpenpayCardTokenAdapter($client, $cardMapper, $config);
        $this->cardAdapter = new OpenpayCardAdapter($client, $cardMapper, $config);

        $customerType = new OpenpayCustomerType();
        $storeMapper = new OpenpayStoreMapper();
        $customerMapper = new OpenpayCustomerMapper($addressMapper, $storeMapper, $customerType);

        $customerValidator = new OpenpayCustomerValidator();
        $this->customerAdapter = new OpenpayCustomerAdapter(
            $customerMapper,
            $customerType,
            $client,
            $customerValidator,
            $config
        );
    }

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    public function test_store_new_card()
    {
        $openpayCustomers = $this->customerAdapter->getList();

        $testCustomerId = $openpayCustomers[count($openpayCustomers)-1]->getId();
        $mockCardInfo = json_decode($this->getMockCardInfo(), true);
        $openpayCardToken = $this->tokenAdapter->store($mockCardInfo);

        $parameters = $this->getMockRequest();
        $parametersArray = json_decode($parameters, true);
        $parametersArray['token_id'] = $openpayCardToken['token_id'];
        $openpayCard = $this->cardAdapter->store($testCustomerId, $parametersArray);

        $this->assertInstanceOf('Openpay\Client\Type\OpenpayCardType', $openpayCard);
        $this->assertNotEmpty($openpayCard->getId(), 'Id is not empty');
    }

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    public function test_get_card_list()
    {
        $openpayCustomers = $this->customerAdapter->getList();

        $testCustomerId = $openpayCustomers[count($openpayCustomers)-1]->getId();
        $openpayCards = $this->cardAdapter->getList($testCustomerId);

        $this->assertGreaterThan(0, count($openpayCards));
        $this->assertInstanceOf('Openpay\Client\Type\OpenpayCardType', $openpayCards[0]);
        $this->assertNotEmpty($openpayCards[0]->getId(), 'Id is not empty');
    }

    public function test_delete_card()
    {
        $openpayCustomers = $this->customerAdapter->getList();
        $testCustomerId = $openpayCustomers[count($openpayCustomers)-1]->getId();
        $openpayCards = $this->cardAdapter->getList($testCustomerId);

        $deleted = $this->cardAdapter->delete($testCustomerId, $openpayCards[0]->getId());

        $this->assertTrue($deleted);
    }

    /**
     * @return string
     */
    protected function getMockRequest()
    {
        $mockJsonRequest = '{
            "token_id":"tokgslwpdcrkhlgxqi9a",
            "device_session_id":"8VIoXj0hN5dswYHQ9X1mVCiB72M7FY9o"
        }';

        return $mockJsonRequest;
    }

    protected function getMockCardInfo()
    {
        $mockCardInfo = '{
            "card_number":"4111111111111111",
            "holder_name":"Juan Perez Ramirez",
            "expiration_year":"20",
            "expiration_month":"12",
            "cvv2":"110"
         }';

        return $mockCardInfo;
    }
}