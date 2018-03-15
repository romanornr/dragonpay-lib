<?php

namespace DragonPay\Client;

use BitWasp\Bitcoin\Network\NetworkInterface;
use DragonPay\InvoiceInterface;
use GuzzleHttp;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Query;
use Money\Money;
use Psr\Http\Message\RequestInterface;
use Money\Currency;
use Money\Exchange\SwapExchange;

class Client implements ClientInterface
{
    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    protected $network;

    public function setNetwork(NetworkInterface $network)
    {
        $this->network = $network;
    }

    public function createInvoice(InvoiceInterface $invoice)
    {
        
        $currency = new Currency('USD');
        $currencySymbol = $currency->getCode();

        $currency = $invoice->getCurrency();
        $item = $invoice->getItem();
        //$buyer

        $date = new \DateTime();
        $invoiceTime = $date->getTimestamp();
        $currentTime = $date->getTimestamp();
       // $invoice->setPrice($item->getPrice());


        // $item = $invoice->getItem();

        $invoice->getCurrency();
        //return dd($invoice->getPrice());

        $invoice
            ->setInvoiceTime($invoiceTime)
            ->setStatus($invoice::STATUS_NEW)
            ->setCurrency($currencySymbol);

        $client = new \GuzzleHttp\Client();
        $url = "http://127.0.0.1:8000/api/invoices";


        $response = $client->request("POST", $url, ['price' => 2]);
        return dd($response);

        //return $invoice;

    }

    public function createNewRequest(string $host, string $method)
    {

        $client = new GuzzleHttp\Client();
        $headers = $this->prepareRequestHeaders();
        //$host = 'https://bittrex.com/api/v1.1/public/getmarkets';
        //$method = 'GET';
        $request =  $client->request($method, $host, $headers);
        $response = $client->post('127.0.0.1:8000/api/invoices', [
           GuzzleHttp\RequestOptions::JSON => []
        ]);

        return $request;
        //return dd(json_decode($request->getBody()));

    }

    public function prepareRequestHeaders()
    {
            $headers = [
                'User-Agent' => 'X-DragonPay-Info', self::NAME, self::VERSION, phpversion(),
                'Accept' => 'application/json',
            ];
            return $headers;
    }
}
