<?php

namespace DragonPay\Rates;

interface RatesInterface
{
    public function fiatIntoCrypto(float $fiatAmount, string $fiatCurrency, string $cryptoCurreny);
    public function fiatIntoSatoshi(float $fiatAmount, string $fiatCurrency, string $cryptoCurrency);
    public function cryptoIntoFiat(): float;
}
