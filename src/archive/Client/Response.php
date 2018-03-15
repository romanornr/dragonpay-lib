<?php

namespace DragonPay\Client;

class Response implements ResponseInterface
{
    /**
     * @var string
     */
    protected $raw;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var integer
     */
    protected $statusCode;

    public function __construct()
    {
        $this->headers = [];
        $this->raw = $raw;
    }

    public function __toString()
    {
        return (string) $this->raw;
    }

    /**
     * @inheritdoc
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return ResponseInterface
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = (integer) $statusCode;
        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
