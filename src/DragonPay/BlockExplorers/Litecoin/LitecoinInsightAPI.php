<?php

namespace DragonPay\BlockExplorers\Litecoin;

use DragonPay\BlockExplorers\InsightAPI;

class LitecoinInsightAPI extends InsightAPI {

    public function __construct()
    {
        $this->network = 'Litecoin';
        $this->api = 'https://insight.litecore.io/api';
    }
}