<?php

namespace DragonPay;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use DragonPay\Helpers;

class DragonPay
{
    private $currency;

    private $network;

    private $xpub;

    public function __construct()
    {
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
        return Helpers::convertFiatIntoBTC('USD', $price);
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
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$this->currency}:{$address}?amount={$amount}";
    }
}

$dragon = new DragonPay();
//$test = $dragon->test();
//
//var_dump($dragon->test());



