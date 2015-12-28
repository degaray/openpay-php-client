<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 22/12/15
 * Time: 03:06 PM
 */

namespace Openpay\Client\Mapper;


use Openpay\Client\Type\OpenpayCardType;

class OpenpayCardMapper
{
    /**
     * @var OpenpayCardType
     */
    protected $cardType;

    /**
     * @var OpenpayAddressMapper
     */
    protected $openpayAddressMapper;

    public function __construct(
        OpenpayCardType $cardType,
        OpenpayAddressMapper $openpayAddressMapper
    ) {
        $this->cardType = $cardType;
        $this->openpayAddressMapper = $openpayAddressMapper;
    }

    /**
     * @param array $data
     * @return OpenpayCardType
     */
    public function create(array $data)
    {
        $newInstance = clone $this->cardType;
        $object = $this->populate($newInstance, $data);

        return $object;
    }

    /**
     * @param OpenpayCardType $object
     * @param array $data
     * @return OpenpayCardType
     */
    public function populate(OpenpayCardType $object, array $data)
    {
        /* Mandatory fields */
        $object->setHolderName($data['holder_name']);
        $object->setExpirationMonth($data['expiration_month']);
        $object->setExpirationYear($data['expiration_year']);

        /* Optional Fields */
        if (isset($data['address'])) {
            $openpayAddressType = $this->openpayAddressMapper->create($data['address']);
            $object->setAddress($openpayAddressType);
        }

        $object->setCvv2(isset($data['cvv2'])? $data['cvv2'] : null);
        $object->setAllowsCharges(isset($data['allows_charges'])? $data['allows_charges'] : null);
        $object->setAllowsPayouts(isset($data['allows_payouts'])? $data['allows_payouts'] : null);
        $object->setBankCode(isset($data['bank_code'])?$data['bank_code'] : null);
        $object->setBankName(isset($data['bank_name'])?$data['bank_name'] : null);
        $object->setBrand(isset($data['brand'])? $data['brand'] : null);
        $object->setCardNumber(isset($data['card_number'])? $data['card_number'] : null);
        $object->setCreationDate(isset($data['creation_date'])? $data['creation_date'] : null);
        $object->setCustomerId(isset($data['customer_id'])? $data['customer_id'] : null);
        $object->setId(isset($data['id'])? $data['id'] : null);
        $object->setPointsCard(isset($data['points_card'])? $data['points_card'] : null);
        $object->setType(isset($data['type'])? $data['type'] : null);

        return $object;
    }
}
