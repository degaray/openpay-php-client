<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 29/01/16
 * Time: 02:05 PM
 */

namespace Openpay\Test\Client;

use Openpay\Client\Adapter\OpenpayCardAdapter;
use Openpay\Client\Adapter\OpenpayChargeAdapter;
use Openpay\Client\Adapter\OpenpayCustomerAdapter;
use Openpay\Client\Mapper\OpenpayAddressMapper;
use Openpay\Client\Mapper\OpenpayBankAccountMapper;
use Openpay\Client\Mapper\OpenpayCardMapper;
use Openpay\Client\Mapper\OpenpayCustomerMapper;
use Openpay\Client\Mapper\OpenpayExceptionMapper;
use Openpay\Client\Mapper\OpenpayStoreMapper;
use Openpay\Client\Mapper\OpenpayTransactionMapper;
use Openpay\Client\Type\OpenpayCardType;
use Openpay\Client\Type\OpenpayCustomerType;
use Openpay\Client\Validator\OpenpayChargeValidator;
use Openpay\Client\Validator\OpenpayCustomerValidator;
use Openpay\Test\Client\Adapter\OpenpayCardTokenAdapter;

class ChargeAdapterTest extends TestAbstract
{
    /**
     * @var OpenpayChargeAdapter
     */
    protected $chargeAdapter;

    /**
     * @var OpenpayCustomerAdapter
     */
    protected $customerAdapter;

    /**
     * @var OpenpayCardTokenAdapter
     */
    protected $tokenAdapter;

    /**
     * @var OpenpayCardAdapter
     */
    protected $cardAdapter;

    /**
     *
     */
    public function setUp()
    {
        $this->setNewChargeAdapter();
        parent::setUp();
    }

    /**
     *
     */
    protected function setNewChargeAdapter()
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
        $openpayExceptionMapper = new OpenpayExceptionMapper();

        $this->tokenAdapter = new OpenpayCardTokenAdapter($client, $cardMapper, $openpayExceptionMapper, $config);
        $this->cardAdapter = new OpenpayCardAdapter($client, $cardMapper, $openpayExceptionMapper, $config);

        $customerType = new OpenpayCustomerType();
        $storeMapper = new OpenpayStoreMapper();
        $customerMapper = new OpenpayCustomerMapper($addressMapper, $storeMapper, $customerType);

        $customerValidator = new OpenpayCustomerValidator();
        $this->customerAdapter = new OpenpayCustomerAdapter(
            $customerMapper,
            $customerType,
            $client,
            $customerValidator,
            $openpayExceptionMapper,
            $config
        );

        $cardType = new OpenpayCardType();
        $addressMapper = new OpenpayAddressMapper();
        $cardMapper = new OpenpayCardMapper($cardType, $addressMapper);
        $openpayExceptionMapper = new OpenpayExceptionMapper();

        $chargeValidator = new OpenpayChargeValidator();
        $bankAccountMapper = new OpenpayBankAccountMapper();

        $transactionMapper = new OpenpayTransactionMapper(
            $bankAccountMapper,
            $cardMapper
        );

        $this->chargeAdapter = new OpenpayChargeAdapter(
            $client,
            $openpayExceptionMapper,
            $chargeValidator,
            $transactionMapper,
            $config
        );
    }

    public function test_charge_customer_account_with_card()
    {
        $openpayCustomers = $this->customerAdapter->getList();

        $testCustomerId = $openpayCustomers[count($openpayCustomers)-1]->getId();
        $mockCardInfo = json_decode($this->getMockCardInfo(), true);
        $openpayCardToken = $this->tokenAdapter->store($mockCardInfo);

        $parameters = $this->getCardMockRequest();
        $parametersArray = json_decode($parameters, true);
        $parametersArray['token_id'] = $openpayCardToken['token_id'];
        $openpayCard = $this->cardAdapter->store($testCustomerId, $parametersArray);

        $chargeMockRequest = $this->getChargeMockRequest();
        $cardId = $openpayCard->getId();
        $parameters = json_decode($chargeMockRequest, true);
        $parameters['source_id'] = $cardId;

        $openpayTransaction = $this->chargeAdapter->chargeCustomerCard($testCustomerId, $parameters);

        $this->assertInstanceOf('Openpay\Client\Type\OpenpayTransactionType', $openpayTransaction);
        $this->assertNotEmpty($openpayTransaction->getId(), 'Id is not empty');
        $this->assertNotEmpty($openpayTransaction->getAuthorization(), 'Authorization number is not empty');
        $this->assertEquals($openpayTransaction->getStatus(), 'completed');
        $this->assertGreaterThan(0, $openpayTransaction->getAmount());
    }

    public function getChargeMockRequest()
    {
        $mockJsonRequest = '{
           "source_id" : "{{card_id}}",
           "method" : "card",
           "amount" : 100,
           "currency" : "MXN",
           "description" : "Cargo inicial a mi cuenta",
           "order_id" : null,
           "device_session_id" : "kR1MiQhz2otdIuUlQkbEyitIqVMiI16f"
        }';

        return $mockJsonRequest;
    }

    /**
     * @return string
     */
    public function getCardMockRequest()
    {
        $mockJsonRequest = '{
            "token_id":"tokgslwpdcrkhlgxqi9a",
            "device_session_id":"8VIoXj0hN5dswYHQ9X1mVCiB72M7FY9o"
        }';

        return $mockJsonRequest;
    }

    /**
     * @return string
     */
    public function getMockCardInfo()
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