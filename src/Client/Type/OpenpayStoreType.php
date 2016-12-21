<?php

namespace Openpay\Client\Type;

use Degaray\Openpay\Api\Data\StoreInterface;

/**
 * Class OpenpayStoreType
 * @package Openpay\Client\Type
 */
class OpenpayStoreType extends TypeAbstract implements StoreInterface
{
    /**
     * @var string
     */
    protected $reference;

    /**
     * @var string
     */
    protected $barcode_url;

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getBarcodeUrl()
    {
        return $this->barcode_url;
    }

    /**
     * @param string $barcode_url
     */
    public function setBarcodeUrl($barcode_url)
    {
        $this->barcode_url = $barcode_url;
    }
}
