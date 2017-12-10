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

    private $totalReceived;

    private $transactionHashEndpoint;

    public function __construct($address)
    {
        $this->currency = 'bitcoin';
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.blockcypher.com/v1/btc/main/addrs/{$address}");
        $res = GuzzleHttp\json_decode($res->getBody());

        $this->transactionHashEndpoint = $res;
        $this->totalReceived = $res->total_received;
    }

    public function isPaid($orderPrice)
    {
        if($this->totalReceived == $orderPrice && $this->transactionHashEndpoint->unconfirmed_n_tx == 0) return true;
        return false;
    }

    public function isConfirmed()
    {
        if($this->transactionHashEndpoint->unconfirmed_n_tx ==0) return true;
    }

//    public function updateTransactionStatus()
//    {
//    }

    public function auditTransaction($orderPrice)
    {
        //foreach save all paid tansactions in database.
    }
}
