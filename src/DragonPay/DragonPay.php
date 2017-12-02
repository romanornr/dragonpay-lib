<?php

namespace DragonPay;

use BitWasp\Bitcoin\PaymentProtocol\RequestBuilder;

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

	public function test()
    {
        $builder = new RequestBuilder();
        $builder->setTime(time()); // this is required
        /* set other details */
        $request = $builder->getPaymentRequest();
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



