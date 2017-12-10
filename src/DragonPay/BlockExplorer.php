<?php

namespace DragonPay;
use GuzzleHttp;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;

abstract class BlockExplorer
{
    /**
     * @var int
     */
    protected $minConfirmations = 3;

    /**
     * @var
     */
    protected $symbol;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var float
     */
    protected $totalReceived;

    /**
     * @var mixed
     */
    protected $transactionHashEndpoint;

    public function totalReceived()
    {
        return $this->totalReceived;
    }

    public function isConfirmed()
    {
        if($this->transactionHashEndpoint->unconfirmed_n_tx == 0) return true;
    }

}

class BitcoinExplorer extends BlockExplorer {

    public function __construct($address)
    {
        $this->currency = 'bitcoin';
        $this->symbol = 'btc';
        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request('GET', "https://api.blockcypher.com/v1/{$this->symbol}/main/addrs/{$address}");
            $res = GuzzleHttp\json_decode($res->getBody());

            $this->transactionHashEndpoint = $res;
            $this->totalReceived = $res->total_received;
        }catch (RequestException $e){
            throw new Exception('API connection problems');
        }
    }

    public function auditTransaction()
    {
        //foreach save all paid tansactions in database.
    }
}


class DashExplorer extends BlockExplorer {

    /**
     * BlockExplorer constructor.
     * @param $address
     */
    public function __construct($address)
    {
        $this->currency = 'dash';
        $this->symbol = 'dash';
        $client = new \GuzzleHttp\Client();

        try {
            $res = $client->request('GET', "https://api.blockcypher.com/v1/{$this->symbol}/main/addrs/{$address}");
            $res = GuzzleHttp\json_decode($res->getBody());

            $this->transactionHashEndpoint = $res;
            $this->totalReceived = $res->total_received;
        }catch (RequestException $e){
            throw new Exception('API connection problems');
        }
    }

    public function auditTransaction()
    {
        //foreach save all paid tansactions in database.
    }
}
