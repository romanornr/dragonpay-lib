<?php

namespace DragonPay\Rates;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class CryptoCompare implements RatesInterface
{

    protected $client;
    protected $satoshi;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://min-api.cryptocompare.com/'
        ]);
    }

    public function fiatIntoCrypto(float $fiatAmount, string $fiatCurrency, string $cryptocurrency)
    {
        $cryptocurrency = strtoupper($cryptocurrency);
        $response = $this->client->get('data/price?fsym=' . $fiatCurrency . '&tsyms=' .$cryptocurrency)->getBody();
        $json = json_decode($response, true);
        $price = $json[$cryptocurrency];
        return $price * $fiatAmount;
    }

    public function fiatIntoSatoshi(float $fiatAmount, string $fiatCurrency, string $cryptoCurrency): int
    {
        $crypto = $this->fiatIntoCrypto($fiatAmount, $fiatCurrency, $cryptoCurrency);
        $this->satoshi = $crypto * 100000000;
        return (int) $this->satoshi;
    }

    public function cryptoIntoFiat(): float
    {

    }
}
