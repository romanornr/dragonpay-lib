<?php

namespace DragonPay;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;

class Helpers
{

    /**
     * @param string $currency
     * @param $amount
     * @return mixed
     */
    public static function convertFiatIntoBTC($currency = 'USD', $amount)
    {
        $client = new GuzzleHttp\Client();

        try {
            $res = $client->request('GET', "https://apiv2.bitcoinaverage.com/convert/global?from={$currency}&to=BTC&amount={$amount}");
            $res = GuzzleHttp\json_decode($res->getBody());
            if(!$res->success) throw new Exception('Can not get the bitcoin price. Please come back later');
            return $res->price;
        } catch (RequestException $e){
            throw new Exception('Can not get the bitcoin price. Please come back later');
           if($e->hasResponse()) echo Psr7\str($e->getResponse());
        }
    }
}
