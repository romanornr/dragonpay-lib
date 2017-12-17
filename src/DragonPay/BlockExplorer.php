<?php

namespace DragonPay;
use GuzzleHttp;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Mockery\Exception;
use DragonPay\Models\Transaction;

//class Transaction
//{
//    protected $explorer;
//
//    public function __construct()
//    {
//        $this->currency = 'bitcoin';
//        $this->symbol = 'btc';
//        $this->client = new Client();
//
//    }
//
//    /**
//     * @return mixed|\Psr\Http\Message\ResponseInterface
//     */
//    public function getTotalReceived()
//    {
//        $data = $this->client->request('GET', "https://api.blockcypher.com/v1/{$this->coin}/main/addrs/{$address}");
//        return $data;
//    }
//}

class ExplorerManager
{
    const BITCOIN = 'bitcoin';
    const DASH = 'dash';

    /**
     * @var array
     */
    protected $explorers = [
        self::BITCOIN => BitcoinExplorer::class,
        self::DASH => DashExplorer::class,
    ];

    /**
     * @param $explorer
     * @return Explorer
     */
    public function getExplorer($explorer): Explorer
    {
        //resolve is a laravel helper for hooking the class
        //dependecy injection
        return resolve($this->explorers[$explorer]);
    }
}

abstract class Explorer
{
    /**
     * @var int
     */
    protected $minConfirmations = 3;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @var string
     */
    protected $currency;

    /**
     * @var int
     */
    protected $totalReceived;

    /**
     * @var mixed
     */
    protected $transactionHashEndpoint;

    /**
     * Check if all transactions are confirmed
     * @return bool
     */
    public function isConfirmed()
    {
        if($this->transactionHashEndpoint->unconfirmed_n_tx == 0) return true;
        return false;
    }

    /**
     * Check how much an address has ever received
     * @param string $address
     * @return mixed
     */
    protected function totalReceived(string $address)
    {
        try {
            $res = $this->client->request('GET', "https://api.blockcypher.com/v1/{$this->symbol}/main/addrs/{$address}");
            $res = GuzzleHttp\json_decode($res->getBody());
            return $res->total_received;
        }catch (RequestException $e){
            throw new Exception('API connection problems');
        }
    }

    /**
     * Insert all transactions from an address into the transaction table
     * @param string $address
     * @return string|void
     */
    protected function auditTransaction(string $address)
    {
        try{
        $res = $this->client->request('GET', "https://api.blockcypher.com/v1/{$this->symbol}/main/addrs/{$address}");
        $res = GuzzleHttp\json_decode($res->getBody());
        }catch (RequestException $e){
            throw new Exception('API connection problems');
        }

        if($res->total_received == 0) return;  // Do not audit if ever received balance is 0

        foreach ($res->txrefs as $txref)
        {
            $tx = new Transaction;
            $txHashCheck = $tx::where('txhash', $txref->tx_hash)->count();
            if($txHashCheck >= 1 || $txref->confirmations == 0 || $txref->double_spend == true) continue;

            $tx->address = $res->address;
            $tx->block_height = $txref->block_height;
            $tx->coin = $this->symbol;
            $tx->txhash = $txref->tx_hash;
            $tx->tx_input_n = $txref->tx_input_n;
            $tx->tx_output_n = $txref->tx_output_n;
            $tx->value = $txref->value;
            $tx->confirmations = $txref->confirmations;
            $tx->confirmed = $txref->confirmed;
            $tx->spent = $txref->spent;
            $tx->save();
        }
        return 'done!';
    }
}

class BitcoinExplorer extends Explorer {

    /**
     * @var Client
     */
    protected $client;

    /**
     * BitcoinExplorer constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->currency = 'bitcoin';
        $this->symbol = 'btc';

    }

    /**
     * Check how much an address has ever received
     * @param string $address
     * @return float
     */
    public function totalReceived(string $address)
    {
        return parent::totalReceived($address);
    }

    public function auditTransaction(string $address)
    {
        //foreach save all paid tansactions in database.
        return parent::auditTransaction($address);
    }
}


class DashExplorer extends Explorer {

    /**
     * DashExplorer constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->currency = 'bitcoin';
        $this->symbol = 'btc';
    }
    public function totalReceived(string $address)
    {
        return parent::totalReceived($address);
    }

    public function auditTransaction(string $address)
    {
        //foreach save all paid tansactions in database.
        return parent::auditTransaction($address);
    }
}
