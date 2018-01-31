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
        //$request = $this->createNewRequest();
        //$this->request->setMethod(Request::METHOD_GET);
//        //$this->response = $this->sentRequest($this->request);
//        $body = json_decode($request->getBody(), true);
//        return dd($body);
//        if (empty($body)) {
//            throw new \Exception('Error with request: no data returned');
//        }

        $currency = new Currency('USD');
        $currencySymbol = $currency->getCode();

        $currency = $invoice->getCurrency();
        $item = $invoice->getItem();

        $date = new \DateTime();
        $invoiceTime = $date->getTimestamp();
        $currentTime = $date->getTimestamp();


        // $item = $invoice->getItem();

        $invoice->getCurrency();

        $invoice
            ->setPrice($invoice->getPrice())
            ->setInvoiceTime($invoiceTime)
            ->setStatus($invoice::STATUS_NEW)
            ->setCurrency($currencySymbol);

        return $invoice;

    }

    public function createNewRequest(string $host, string $method)
    {

        $client = new GuzzleHttp\Client();
        $headers = $this->prepareRequestHeaders();
        //$host = 'https://bittrex.com/api/v1.1/public/getmarkets';
        //$method = 'GET';
        $request =  $client->request($method, $host, $headers);

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
