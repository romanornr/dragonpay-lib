<?php

namespace DragonPay\BlockExplorers;
use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;
use DragonPay\Models\Transaction;

abstract class InsightAPI implements BlockExplorerInterface {

    protected $network;

    protected $api;

    public function getAddressHistory()
    {
        // TODO: Implement getAddressHistory() method.
    }

    protected function setApi(string $url)
    {
       $this->api = $url;
    }

    public function getAddressTotalReceived(string $address): int
    {
        $client = new GuzzleHttp\Client();
        try {
            $res = $client->request('GET', "{$this->api}/addr/{$address}/totalReceived");
            return GuzzleHttp\json_decode($res->getBody());
        }catch (RequestException $e){
            throw new Exception('API connection problems');
        }
    }
}