<?php
/**
 * Created by Xavier de Garay.
 * User: degaray
 * Date: 8/01/16
 * Time: 04:16 PM
 */

namespace Openpay\Client\Mapper;


use Openpay\Client\Exception\OpenpayException;

class OpenpayExceptionMapper
{

    /**
     * @param array $data
     * @param OpenpayException|null $exception
     * @return OpenpayException
     */
    public function create(array $data, OpenpayException $exception = null)
    {
        if (is_null($exception)) {
            $exception = new OpenpayException();
        }

        $exception = $this->populate($exception, $data);

        return $exception;
    }

    /**
     * @param OpenpayException $exception
     * @param array $data
     * @return OpenpayException
     */
    public function populate(OpenpayException $exception, array $data)
    {
        $exception->setCategory((isset($data['category']))? $data['category'] : null);
        $exception->setDescription((isset($data['description']))? $data['description'] : null);
        $exception->setErrorCode((isset($data['error_code']))? $data['error_code'] : null);
        $exception->setFraudRules((isset($data['fraud_rules']))? $data['fraud_rules'] : null);
        $exception->setHttpCode((isset($data['http_code']))? $data['http_code'] : null);
        $exception->setRequestId((isset($data['request_id']))? $data['request_id'] : null);

        return $exception;
    }
}