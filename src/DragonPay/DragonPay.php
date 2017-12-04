<?php

namespace DragonPay;

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
        $builder = new RequestBuilder();
        $builder->setTime(1);
        $pubkey = PublicKeyFactory::fromHex('0496b538e853519c726a2c91e61ec11600ae1390813a627c66fb8be7947be63c52da7589379515d4e0a604f8141781e62294721166bf621e73a82cbf2342c858ee');
        $address = AddressFactory::fromKey($pubkey);
        $script = ScriptFactory::scriptPubKey()->payToAddress($address);

        $builder->addAddressPayment($address, 50);
        $request = $builder->getPaymentDetails();
        $output = $request->getOutputs();
        return dd($address);
    }

    // Step 0: Buyer clicks purchase on the website
    // Step 1: Website generates a payment request, $amount (ie 50000) satoshis
    // Request is saved and a URL given to the client.
	public function createDetails($amount)
    {
        $math = new Math();
        $random = new Random();

        $http = new HttpResponse();
        $merchantRandom = $random->bytes(16);
        $destination = ScriptFactory::sequence([Opcodes::OP_DUP, Opcodes::OP_HASH160, $random->bytes(20), Opcodes::OP_EQUALVERIFY, Opcodes::OP_CHECKSIG]);
        $output = new TransactionOutput($amount, $destination);
       // $requestSigner = RequestSigner::sha256($this->getKey(), $this->getCert());
        $builder = new RequestBuilder();
        $builder
            ->setTime(time())
            ->setExpires((new \DateTime('+1h'))->getTimestamp())
            ->setMemo('Payment for 1 shoes')
            ->setMerchantData($merchantRandom->getBinary())
            ->setNetwork('main')
            ->setOutputs([$output])
            ->setPaymentUrl('https://example.com/payment');
           // ->setSigner($requestSigner)
        //return dd($builder);
       $request = $builder->getPaymentRequest();
       return dd($request);
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



