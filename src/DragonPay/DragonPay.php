<?php

namespace DragonPay;

use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Address\AddressFactory;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Script\P2shScript;
use BitWasp\Bitcoin\Script\ScriptFactory;
use DragonPay\Helpers;

class DragonPay
{
    private $currency;

    private $network;

    private $xpub;

    /**
     * DragonPay constructor.
     */
    public function __construct()
    {
        $this->currency = 'bitcoin';
        $this->network = Bitcoin::getNetwork();
        $this->xpub = 'xpub6DBfFoZHK5ZCzuoViVTzmRTf91DEVvYoifJQToHhHAwS2pmyeQCfQ5pqCg65WYBB2jnyDtoPRdpLVgwH5UpFswFX1qNtD4ccpZJXB9fqkQA'; //ledger
    }

    /**
     * Create HD address for the order ID
     *
     * @param integer $orderid
     * @return string
     */
    public function createTransactionAddress(int $orderid)
    {

        /**
         * @param HierarchicalKey $key
         * @param $purpose
         * @return \BitWasp\Bitcoin\Address\AddressInterface
         */
        function toAddress(HierarchicalKey $key, $purpose) {
            switch ($purpose) {
                case 44:
                    $script = ScriptFactory::scriptPubKey()->p2pkh($key->getPublicKey()->getPubKeyHash());
                    break;
                case 49:
                    $rs = new P2shScript(ScriptFactory::scriptPubKey()->p2wkh($key->getPublicKey()->getPubKeyHash()));
                    $script = $rs->getOutputScript();
                    break;
                default:
                    throw new \InvalidArgumentException("Invalid purpose");
            }
            return AddressFactory::fromOutputScript($script);
        }

        $purpose = 49;
        $purposePub = $this->xpub;
        $xpub = HierarchicalKeyFactory::fromExtended($purposePub);

        $orderAddress = toAddress($xpub->derivePath("0/{$orderid}"), $purpose)->getAddress(); //orderid as childkey
        return $orderAddress;
       //echo "0/1: ".toAddress($xpub->derivePath("0/1"), $purpose)->getAddress().PHP_EOL;
    }

    /**
     * Return the bitcoin price when a dollar price is given.
     *
     * @param $price
     * @return int
     */
    public function getBitcoinPrice(float $price): float
    {
        return Helpers::convertFiatIntoBTC('USD', $price);
    }

    public function getSatoshi(float $price): int
    {
        return Helpers::convertIntoSatoshi($price);
    }

    /**
     * Create a payment QR code by the address and bitcoin/crypto amount
     *
     * @param $address
     * @param $amount
     * @return string
     */
    public function createQRcode(string $address, float $amount): string
    {
        return "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={$this->currency}:{$address}?amount={$amount}";
    }
}

