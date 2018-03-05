<?php

namespace DragonPay\Rates;

interface RatesInterface
{
    public function fiatIntoCrypto(float $fiatAmount, string $fiatCurrency, string $cryptocurreny);
    public function fiatIntoSatoshi(float $fiatAmount, string $fiatCurrency, string $cryptoCurrency): int;
    public function cryptoIntoFiat(): float;
}
