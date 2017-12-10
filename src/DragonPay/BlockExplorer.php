<?php

namespace DragonPay;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;

class BlockExplorer {

    /**
     * @var int
     */
    protected $minConfirmations = 3;

    /**
     * @var
     */
    private $network;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $totalReceived;

    /**
     * @var mixed
     */
    private $transactionHashEndpoint;

    /**
     * BlockExplorer constructor.
     * @param $address
     */
    public function __construct($address)
    {
        $this->currency = 'bitcoin';
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', "https://api.blockcypher.com/v1/btc/main/addrs/{$address}");
        $res = GuzzleHttp\json_decode($res->getBody());

        $this->transactionHashEndpoint = $res;
        $this->totalReceived = $res->total_received;
    }

    /**
     * Check how much satoshi the address received
     * @return integer
     */
    public function totalReceived()
    {
        return $this->totalReceived;
    }

    /**
     * Check if all transactions are confirmed
     * @return bool
     */
    public function isConfirmed()
    {
        if($this->transactionHashEndpoint->unconfirmed_n_tx == 0) return true;
    }

//    public function updateTransactionStatus()
//    {
//    }

    public function auditTransaction()
    {
        //foreach save all paid tansactions in database.
    }
}
