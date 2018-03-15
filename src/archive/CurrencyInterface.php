<?php

namespace DragonPay;

interface CurrencyInterface
{
    /**
     * @return null|string
     */
    public function getCode(): ?string;

    /**
     * @return null|string
     */
    public function getSymbol(): ?string ;

    /**
     * @return int|null
     */
    public function getPrecision(): ?int;

    /**
     * @return null|string
     */
    public function getExchangePercentageFee(): ?string;

    /**
     * @return bool
     */
    public function isPayoutEnabled(): bool;

    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @return null|string
     */
    public function getPluralName(): ?string;

    /**
     * @return array
     */
    public function getAlts();

    /**
     * @return array
     */
    public function getPayoutFields(): array;
}
