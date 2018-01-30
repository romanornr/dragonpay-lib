<?php

namespace DragonPay\Client;

/**
 * Interface ResponseInterface
 * @package DragonPay\Client
 */
Interface ResponseInterface
{
    /**
     * @return string
     */
    public function getBody(): string ;

    /**
     * @return integer
     */
    public function getStatusCode(): int;

    /**
     * Returns a $key => $value array of http headers
     * @return array
     */
    public function getHeaders(): array;
}
