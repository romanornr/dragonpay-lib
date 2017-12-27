<?php

namespace DragonPay\BlockExplorers\Bitcoin;

use DragonPay\BlockExplorers\InsightAPI;

class BitcoinInsightAPI extends InsightAPI {

    public function __construct()
    {
        $this->network = 'Bitcoin';
        $this->api = 'https://localbitcoinschain.com/api';
    }
}