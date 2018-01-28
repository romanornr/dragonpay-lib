<?php

namespace DragonPay;

interface CurrencyInterface
{
    /**
     * @return string
     */
    public function getCode(): string;

    /**
     * @return string
     */
    public function getSymbol(): string ;

    /**
     * @return string
     */
    public function getPrecision(): string;

    /**
     * @return string
     */
    public function getExchangePercentFee(): string;

    /**
     * @return bool
     */
    public function isPayoutEnabled(): bool;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getPluralName(): string;

    /**
     * @return array
     */
    public function getAlts(): array;

    /**
     * @return array
     */
    public function getPayoutFields(): array;
}
