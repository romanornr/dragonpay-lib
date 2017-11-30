<?php

namespace DragonPay\Facades;

use Illuminate\Support\Facades\Facade;

class DragonPay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'dragonpay';
    }
}