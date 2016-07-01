<?php

namespace Openpay\Client\Adapter;

use Openpay\Client\Type\OpenpayTransactionType;

interface OpenpayCustomerTransferInterface
{
    /**
     * @param int $senderId
     * @param array $parameters
     * @return OpenpayTransactionType
     */
    public function transfer($senderId, $parameters);
}
