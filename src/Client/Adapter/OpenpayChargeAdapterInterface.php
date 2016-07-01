<?php
namespace Openpay\Client\Adapter;

use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Type\OpenpayTransactionType;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 1/02/16
 * Time: 09:33 AM
 *
 * Interface OpenpayChargeAdapterInterface
 * @package Openpay\Client\Adapter
 */
interface OpenpayChargeAdapterInterface
{
    /**
     * @param $customerId
     * @param $parameters
     * @return OpenpayTransactionType
     * @throws OpenpayException
     */
    public function chargeCustomerCard($customerId, $parameters);
}
