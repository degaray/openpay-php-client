<?php

namespace Openpay\Client\Adapter;
use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Type\OpenpayCustomerType;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 29/12/15
 * Time: 11:49 AM
 *
 * Interface OpenpayCustomerAdapterInterface
 * @package Openpay\Client\Adapter
 */
interface OpenpayCustomerAdapterInterface
{
    /**
     * @param $customerId string
     * @return OpenpayCustomerType
     * @throws OpenpayException
     */
    public function get($customerId);

    /**
     * @param array $parameters
     * @return OpenpayCustomerType
     * @throws OpenpayException
     */
    public function store(array $parameters);

    /**
     * @return OpenpayCustomerType[]
     * @throws OpenpayException
     */
    public function getList();
}
