<?php

namespace DragonPay\CryptoCurrencies;

use BitWasp\Bitcoin\Network\NetworkFactory;
use BitWasp\Bitcoin\Network\Network;

class Litecoin implements Cryptocurrency {

    public function getNetwork(): Network
    {
        return NetworkFactory::litecoin();
    }
}
