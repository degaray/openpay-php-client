<?php
/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 28/01/16
 * Time: 12:57 PM
 */

namespace Openpay\Client\Mapper;

use Openpay\Client\Type\OpenpayTransactionType;

class OpenpayTransactionMapper
{
    /**
     * @var OpenpayBankAccountMapper
     */
    protected $bankAccountMapper;

    /**
     * @var OpenpayCardMapper
     */
    protected $cardMapper;

    /**
     * OpenpayTransactionMapper constructor.
     * @param OpenpayBankAccountMapper $bankAccountMapper
     * @param OpenpayCardMapper $cardMapper
     */
    public function __construct(
        OpenpayBankAccountMapper $bankAccountMapper,
        OpenpayCardMapper $cardMapper
    ) {
        $this->bankAccountMapper = $bankAccountMapper;
        $this->cardMapper = $cardMapper;
    }

    /**
     * @param array $data
     * @param OpenpayTransactionType|null $object
     * @return OpenpayTransactionType
     */
    public function create(
        array $data,
        OpenpayTransactionType $object = null
    ) {
        if (is_null($object)) {
            $object = new OpenpayTransactionType();
        }

        $newInstance = clone $object;
        $object = $this->populate($newInstance, $data);

        return $object;
    }

    /**
     * @param OpenpayTransactionType $object
     * @param array $data
     * @return OpenpayTransactionType
     */
    public function populate(OpenpayTransactionType $object, array $data)
    {
        if (isset($data['id'])) {
            $object->setId($data['id']);
        }

        if (isset($data['authorization'])) {
            $object->setAuthorization($data['authorization']);
        }

        if (isset($data['transaction_type'])) {
            $object->setTransactionType($data['transaction_type']);
        }

        if (isset($data['operation_type'])) {
            $object->setOperationType($data['operation_type']);
        }

        if (isset($data['method'])) {
            $object->setMethod($data['method']);
        }

        if (isset($data['creation_date'])) {
            $object->setCreationDate(\DateTime::createFromFormat('Y-m-d*H:i:sO', $data['creation_date']));
        }

        if (isset($data['order_id'])) {
            $object->setOrderId($data['order_id']);
        }

        if (isset($data['status'])) {
            $object->setStatus($data['status']);
        }

        if (isset($data['amount'])) {
            $object->setAmount($data['amount']);
        }

        if (isset($data['description'])) {
            $object->setDescription($data['description']);
        }

        if (isset($data['error_message'])) {
            $object->setErrorMessage($data['error_message']);
        }

        if (isset($data['customer_id'])) {
            $object->setCustomerId($data['customer_id']);
        }

        if (isset($data['currency'])) {
            $object->setCurrency($data['currency']);
        }

        if (isset($data['bank_account'])) {
            $object->setBankAccount($this->bankAccountMapper->create($data['bank_account']));
        }

        if (isset($data['card'])) {
            $object->setCard($this->cardMapper->create($data['card']));
        }

        if (isset($data['card_points'])) {
            $object->setCardPoints($data['card_points']);
        }

        return $object;
    }
}
