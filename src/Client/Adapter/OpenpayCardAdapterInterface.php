<?php

namespace Openpay\Client\Adapter;


use Openpay\Client\Exception\OpenpayException;
use Openpay\Client\Type\OpenpayCardType;

/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 29/12/15
 * Time: 11:48 AM
 *
 * Interface OpenpayCardAdapterInterface
 * @package Openpay\Client\Adapter
 */
interface OpenpayCardAdapterInterface
{
    /**
     * @param $customerId
     * @param array $findDataRequest
     * @return array
     * @throws OpenpayException
     */
    public function getList($customerId, array $findDataRequest = []);

    /**
     * @param $customerId
     * @param array $parameters
     * @return OpenpayCardType
     * @throws OpenpayException
     */
    public function store($customerId, array $parameters);

    /**
     * @param $customerId string
     * @param $cardId string
     * @return bool
     * @throws OpenpayException
     */
    public function delete($customerId, $cardId);
}
