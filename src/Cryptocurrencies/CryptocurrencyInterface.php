<?php

namespace DragonPay\CryptoCurrencies;

use BitWasp\Bitcoin\Network\Network;

interface Cryptocurrency
{
    public function getNetwork(): Network;
}
