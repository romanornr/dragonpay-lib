<?php

namespace DragonPay\CryptoCurrencies;

class CryptocurrencyFactory
{
    public static function bitcoin(): Cryptocurrency
    {
        return new Bitcoin();
    }

    public static function bitcointestnet(): Cryptocurrency
    {
        return new BitcoinTestnet();
    }

    public static function viacoin(): Cryptocurrency
    {
        return new Viacoin();
    }

    public function litecoin(): Cryptocurrency
    {
        return new Litecoin();
    }

}
