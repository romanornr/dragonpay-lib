<?php

namespace DragonPay;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;

class BlockExplorer {

    protected $minConfirmations = 3;

    private $network;

    private $currency;

    private $address;

    private $totalReceived;

    public function __construct($address)
    {
        $this->currency = 'bitcoin';
        $this->address = $address;

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.blockcypher.com/v1/btc/main/addrs/{$this->address}");
        $res = GuzzleHttp\json_decode($res->getBody());
        echo $res->total_received;
    }

    public function isConfirmed(Address $address)
    {
    }

    public function updateTransactionStatus()
    {
    }
}

$blockExplorer = new BlockExplorer();
