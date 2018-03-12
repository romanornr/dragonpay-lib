<?php

namespace DragonPay\CryptoCurrencies;

use BitWasp\Bitcoin\Network\NetworkFactory;
use BitWasp\Bitcoin\Network\Network;

class Viacoin implements Cryptocurrency {

    public function getNetwork(): Network
    {
        return NetworkFactory::viacoin();
    }
}
