<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 8/01/16
 * Time: 04:45 PM
 */

namespace Openpay\Test\Client;


use Openpay\Client\Adapter\OpenpayCustomerAdapter;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Mapper\OpenpayAddressMapper;
use Openpay\Client\Mapper\OpenpayCustomerMapper;
use Openpay\Client\Mapper\OpenpayExceptionMapper;
use Openpay\Client\Mapper\OpenpayStoreMapper;
use Openpay\Client\Type\OpenpayCustomerType;
use Openpay\Client\Validator\OpenpayCustomerValidator;

class AdapterExceptionTest extends TestAbstract
{
    /**
     * @var OpenpayCustomerAdapter
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $customerId;

    /**
     *
     */
    public function setUp()
    {
        $this->setNewCustomerAdapter();
        parent::setUp();
    }

    /**
     *
     */
    protected function setNewCustomerAdapter()
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

        /*
         * Prepare Dependencies
         */
        $addressMapper = new OpenpayAddressMapper();
        $storeMapper = new OpenpayStoreMapper();
        $openpayCustomerType = new OpenpayCustomerType();
        $customerMapper = new OpenpayCustomerMapper($addressMapper, $storeMapper, $openpayCustomerType);
        $customerType = new OpenpayCustomerType();
        $customerValidator = new OpenpayCustomerValidator();
        $openpayExceptionMapper = new OpenpayExceptionMapper();

        $this->adapter = new OpenpayCustomerAdapter(
            $customerMapper,
            $customerType,
            $client,
            $customerValidator,
            $openpayExceptionMapper,
            $config
        );
    }

    public function test_store_new_customer_without_name()
    {
        $mockRequest = $this->getMockRequest();

        $mockArrayRequest = json_decode($mockRequest, true);
        $mockArrayRequest['external_id'] = 'ZXWY' . rand(1, 1000000);
        unset($mockArrayRequest['name']);
        try {
            $openpayCustomer = $this->adapter->store($mockArrayRequest);
        } catch (OpenpayException $e) {
            $this->assertEquals($e->getCode(), 400);
            $this->assertEquals($e->getErrorCode(), 1001);
        }
    }

    /**
     * @return string
     */
    protected function getMockRequest()
    {
        $mockJsonRequest = '{
           "name":"Rodrigo",
           "last_name":"Velazco Perez",
           "email":"rodrigo.velazco@payments.com",
           "phone_number":"4425667045",
           "external_id":"cliente1",
           "status":"active",
           "balance":103,
           "address":{
              "line1":"Av. 5 de febrero No. 1080 int Roble 207",
              "line2":"Carrillo puerto",
              "line3":"Zona industrial carrillo puerto",
              "postal_code":"06500",
              "state":"Querétaro",
              "city":"Querétaro",
              "country_code":"MX"
           },
           "clabe": "646180109400423323"
        }';

        return $mockJsonRequest;
    }

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    /*public function test_get_customer_list()
    {
        $openpayCustomers = $this->adapter->getList();

        $this->assertGreaterThan(0, count($openpayCustomers));
        $this->assertInstanceOf('Openpay\Client\Type\OpenpayCustomerType', $openpayCustomers[0]);
        $this->assertNotEmpty($openpayCustomers[0]->getId(), 'Id is not empty');
    }*/

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    protected function getACustomerId()
    {
        $openpayCustomers = $this->adapter->getList();

        $testCustomerId = $openpayCustomers[0]->getId();
        $this->customerId = $testCustomerId;
    }

    /**
     * @throws \Openpay\Client\Exception\OpenpayException
     */
    /*public function test_example()
    {
        $this->setNewCustomerAdapter();
        $this->getACustomerId();
        $openpayCustomer = $this->adapter->get($this->customerId);
        $this->assertInstanceOf('Openpay\Client\Type\OpenpayCustomerType', $openpayCustomer);
        $this->assertNotEmpty($openpayCustomer->getId(), 'Id is not empty');
    }*/
}
