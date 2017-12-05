<?php

namespace DragonPay;

use BitWasp\Bitcoin\Address\AddressFactory;
use BitWasp\Bitcoin\Crypto\Random\Random;
use BitWasp\Bitcoin\Math\Math;
use BitWasp\Bitcoin\PaymentProtocol\HttpResponse;
use BitWasp\Bitcoin\PaymentProtocol\PaymentHandler;
use BitWasp\Bitcoin\PaymentProtocol\PaymentVerifier;
use BitWasp\Bitcoin\PaymentProtocol\Protobufs\Output;
use BitWasp\Bitcoin\PaymentProtocol\Protobufs\Payment;
use BitWasp\Bitcoin\PaymentProtocol\Protobufs\PaymentACK;
use BitWasp\Bitcoin\PaymentProtocol\Protobufs\PaymentDetails;
use BitWasp\Bitcoin\PaymentProtocol\Protobufs\PaymentRequest;
use BitWasp\Bitcoin\PaymentProtocol\RequestBuilder;
use BitWasp\Bitcoin\PaymentProtocol\RequestSigner;
use BitWasp\Bitcoin\Script\Opcodes;
use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Transaction\Factory\TxBuilder;
use BitWasp\Bitcoin\Transaction\TransactionOutput;
use BitWasp\Buffertools\Buffer;

class DragonPay
{

	/**
	 * The vendor can choose a minimum confirmation amount
	 * before the transaction is considered confirmed,
	 */
	protected $minConfirmations = 0;

    /**
     * The blockexplorer we will be using
     */
    protected $explorer;

    public function __construct($explorer)
    {
        $this->explorer = $explorer;
    }

	/**
	 * When the payment is received but not yet confirmed this will return true
     *
     * @return boolean
	 */
	public function transactionPaid($address)
	{
		$transactions = $this->explorer->getTransactions($address);

		return count($transactions);
	}

	public function builtAddress()
    {

    }

    // Step 0: Buyer clicks purchase on the website
    // Step 1: Website generates a payment request, $amount (ie 50000) satoshis
    // Request is saved and a URL given to the client.
	public function createDetails($amount)
    {
        $math = new Math();
        $random = new Random();
        $time = time();

        $http = new HttpResponse();
        $merchantRandom = $random->bytes(16);
        $destination = '1KmftT8rrcQJ6msn81hJPWrgoVBkkud5NH';
        $paymentUrl = 'http://127.0.0.1:8080/payment?time=' . $time;

        $address = AddressFactory::fromString($destination);
        $builder = new RequestBuilder();
        $builder
            ->setTime($time)
            ->setExpires((new \DateTime('+1h'))->getTimestamp())
            ->setMemo('Payment for 1 item')
            ->setMerchantData($merchantRandom->getBinary())
            ->setNetwork('main')
            ->setPaymentUrl($paymentUrl)
            ->addAddressPayment($address, $amount);

        $encodedUrl = urlencode($paymentUrl);
        $uri = "bitcoin:{$destination}?r={$encodedUrl}&amount={$amount}";
        $qr = urlencode($uri);
        echo "<a href='{$uri}'>Pay<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$qr}'></a>";
        return;

    }

    /**
     *
     * @return boolean
     */
	public function transactionConfirmed($address)
	{

		// Get the first transaction
		$transaction = $this->explorer->getTransactions($address)[0];


		return $this->minConfirmations >= $transaction->confirmations();

	}

    /**
     * Return the status of the transaction
     *
     * @return array
     */
    public function transactionStatus($address)
    {

        return [
            'paid' => $this->transactionPaid($address),
            'confirmed' => $this->transactionConfirmed($address)
        ];

    }

}

$dragon = new DragonPay(null);
//$test = $dragon->test();
//
//var_dump($dragon->test());



