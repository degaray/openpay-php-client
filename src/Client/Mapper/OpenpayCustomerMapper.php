<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 17/12/15
 * Time: 11:14 AM
 */

namespace Openpay\Client\Mapper;


use Openpay\Client\Type\OpenpayCustomerType;

class OpenpayCustomerMapper
{
    /**
     * @var OpenpayAddressMapper
     */
    protected $addressMapper;

    /**
     * @var OpenpayStoreMapper
     */
    protected $storeMapper;

    /**
     * @var OpenpayCustomerType
     */
    protected $openpayCustomerType;

    /**
     * OpenpayCustomerMapper constructor.
     * @param OpenpayAddressMapper $addressMapper
     * @param OpenpayStoreMapper $storeMapper
     * @param OpenpayCustomerType $openpayCustomerType
     */
    public function __construct(
        OpenpayAddressMapper $addressMapper,
        OpenpayStoreMapper $storeMapper,
        OpenpayCustomerType $openpayCustomerType
    ) {
        $this->addressMapper = $addressMapper;
        $this->storeMapper = $storeMapper;
        $this->openpayCustomerType = $openpayCustomerType;
    }

    /**
     * @param array $data
     * @return OpenpayCustomerType
     */
    public function create(array $data)
    {
        $newInstance = clone $this->openpayCustomerType;
        $object = $this->populate($newInstance, $data);

        return $object;
    }

    /**
     * @param OpenpayCustomerType $object
     * @param array $data
     * @return OpenpayCustomerType
     */
    public function populate(OpenpayCustomerType $object, array $data)
    {
        $object->setName($data['name']);
        $object->setLastName($data['last_name']);
        $object->setEmail($data['email']);
        $object->setPhoneNumber($data['phone_number']);
        $object->setClabe($data['clabe']);

        if (isset($data['address'])) {
            $addressType = $this->addressMapper->create($data['address']);
            $object->setAddress($addressType);
        }
        if (isset($data['creation_date'])) {
            $object->setCreationDate($data['creation_date']);
        }
        if (isset($data['id'])) {
            $object->setId($data['id']);
        }
        if (isset($data['status'])) {
            $object->setStatus($data['status']);
        }
        if (isset($data['balance'])) {
            $object->setBalance($data['balance']);
        }
        if (isset($data['store'])) {
            $storeType = $this->storeMapper->create($data['store']);
            $object->setStore($storeType);
        }

        return $object;
    }
}