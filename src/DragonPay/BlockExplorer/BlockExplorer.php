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

    private $addresses;

    private $totalReceived;

    public function __construct()
    {
        $this->currency = 'bitcoin';

        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'https://api.blockcypher.com/v1/btc/main/addrs/1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD');
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
