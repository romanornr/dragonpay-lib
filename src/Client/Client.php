<?php

namespace DragonPay\Client;

use BitWasp\Bitcoin\Network\NetworkInterface;
use DragonPay\InvoiceInterface;
use GuzzleHttp;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Query;
use Psr\Http\Message\RequestInterface;

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

    public function createInvoice()
    {
        $request = $this->createNewRequest();
        //$this->request->setMethod(Request::METHOD_GET);
        //$this->response = $this->sentRequest($this->request);
        $body = json_decode($request->getBody(), true);
        return dd($body);
        if (empty($body)) {
            throw new \Exception('Error with request: no data returned');
        }

    }

    public function createNewRequest()
    {

        //$request = new Request('GET', 'https://bittrex.com/api/v1.1/public/getmarkets');
        $client = new GuzzleHttp\Client();
        $headers = $this->prepareRequestHeaders();
        $host = 'https://bittrex.com/api/v1.1/public/getmarkets';
        $method = 'GET';
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
