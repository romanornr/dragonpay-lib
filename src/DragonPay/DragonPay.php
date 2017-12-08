<?php

namespace DragonPay;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use Illuminate\Support\Facades\App;
use DragonPay\Helpers;

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

    private $currency;

    private $network;

    private $xpub;

    public function __construct($explorer)
    {
        $this->explorer = $explorer;
        $this->currency = 'bitcoin';
        $this->network = Bitcoin::getNetwork();
        $this->xpub = 'xpub661MyMwAqRbcGtwgccWjqwtZZhPhtTkuUHc9A86jkEsh8XSbYfMS6WDpSc7qGUyRHdvxJPsjaCQJanwJkjxJxofJT6igsnGhsE5f7wv94Yt';
    }

    /**
     * Create HD address for the order ID
     *
     * @param integer $orderid
     * @return string
     */
    public function createTransactionAddress($orderid)
    {
        $hk = HierarchicalKeyFactory::fromExtended($this->xpub, $this->network);
        $master = $hk->derivePath("0/0/0/{$orderid}");
        $address = $master->getPublicKey();
        $orderAddress = $address->getAddress()->getAddress($this->network);

        return $orderAddress;
    }

    /**
     * Return the bitcoin price when a dollar price is given.
     *
     * @param $price
     * @return int
     */
    public function getBitcoinPrice($price)
    {
        Helpers::convertFiatIntoBTC('USD', $price);
    }

    /**
     * Create a payment QR code by the address and bitcoin/crypto amount
     *
     * @param $address
     * @param $amount
     * @return string
     */
    public function createQRcode($address, $amount)
    {
        return "<a href='{$uri}'>Pay<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$this->currency}:{$address}?amount={$amount}'></a>";
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

    public function payment($time)
    {
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



