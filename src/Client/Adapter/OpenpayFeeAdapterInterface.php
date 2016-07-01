<?php
namespace Openpay\Client\Adapter;

use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Type\OpenpayTransactionType;

/**
 * Created by PhpStorm.
 * User: xavier
 * Date: 10/02/16
 * Time: 15:33 AM
 *
 * Interface OpenpayFeeAdapterInterface
 * @package Openpay\Client\Adapter
 */
interface OpenpayFeeAdapterInterface
{
    /**
     * @param $parameters
     * @return OpenpayTransactionType
     * @throws OpenpayException
     */
    public function chargeFee($parameters);
}
