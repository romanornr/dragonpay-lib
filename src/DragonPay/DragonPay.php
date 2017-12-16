<?php

namespace DragonPay;

use BitWasp\Bitcoin\Address\PayToPubKeyHashAddress;
use BitWasp\Bitcoin\Address\SegwitAddress;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Address\AddressFactory;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Mnemonic\Bip39\Bip39SeedGenerator;
use BitWasp\Bitcoin\Script\P2shScript;
use BitWasp\Bitcoin\Script\ScriptFactory;

use BitWasp\Bitcoin\Script\ScriptInfo\PayToPubkey;
use DragonPay\Helpers;
use BitWasp\Bitcoin\Script\WitnessScript;
use BitWasp\Bitcoin\SegwitBech32;

use BitWasp\Bitcoin\Address\ScriptHashAddress;
use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use BitWasp\Bitcoin\Script\WitnessProgram;
use FG\X509\PrivateKey;


class DragonPay
{
    private $currency;

    private $network;

    private $xpub;

    public function __construct()
    {
        $this->currency = 'bitcoin';
        $this->network = Bitcoin::getNetwork();
        //$this->xpub = 'xpub661MyMwAqRbcFAFDEfY3zn6qzmH66pVbPU3F4SzLG8dZvueGVHTmCcttqZcDpnVZQqMz8e5ZRXFmVzzMd6maedjtsQsLpNRZ9GZ2ya6exMH';
        $this->xpub = 'xpub6CbK8MSWq77LAbHCUnUqDyZaMN88y4JGnYWx7hepu5146rdisd59BV4yD68PUxx3Rxp2VgYfdygqdgaoux7jfbMsY9qEg8NafLm6NxTNftU'; //ledger
    }

    /**
     * Create HD address for the order ID
     *
     * @param integer $orderid
     * @return string
     */
    public function createTransactionAddress($orderid)
    {

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

        $mnemonic = "letter business goat metal grain depart case resource universe blood main destroy empty invest fiscal hint enhance fragile guess return frame shaft number impact";
        $bip39 = new Bip39SeedGenerator();
        $seed = $bip39->getSeed($mnemonic);
        $purpose = 49;
        $root = HierarchicalKeyFactory::fromEntropy($seed);
        echo "Root key (m): " . $root->toExtendedKey() . PHP_EOL;
        echo "Root key (M): " . $root->toExtendedPublicKey() . PHP_EOL;
        echo "\n\n -------------- \n\n";
        echo "Derive (m -> m/{$purpose}'/0'/0'): \n";
        $purposePriv = $root->derivePath("{$purpose}'/0'/0'");
        echo "m/{$purpose}'/0'/0': ".$purposePriv->toExtendedPrivateKey().PHP_EOL;
        echo "M/{$purpose}'/0'/0': ".$purposePriv->toExtendedPublicKey().PHP_EOL;
        echo "Derive (M -> m/{$purpose}'/0'/0'): .... should fail\n";
        try {
            $rootPub = $root->toPublic()->derivePath("{$purpose}'/0'/0'");
        } catch (\Exception $e) {
            echo "caught exception, yes this is impossible: " . $e->getMessage().PHP_EOL;
        }
        $purposePub = $purposePriv->toExtendedPublicKey();
        echo "\n\n -------------- \n\n";
        echo "initialize from xpub (M/{$purpose}'/0'/0'): \n";
        $xpub = HierarchicalKeyFactory::fromExtended($purposePub);
        echo "0/0: ".toAddress($xpub->derivePath("0/0"), $purpose)->getAddress().PHP_EOL;
        echo "0/1: ".toAddress($xpub->derivePath("0/1"), $purpose)->getAddress().PHP_EOL;

return;

       // $hk = HierarchicalKeyFactory::fromExtended($this->xpub, $this->network);
//        $priv = PrivateKeyFactory::fromWif('L1U6RC3rXfsoAx3dxsU1UcBaBSRrLWjEwUGbZPxWX9dBukN345R1');
//        $publicKey = $priv->getPublicKey();
//        $pubKeyHash = $publicKey->getPubKeyHash();
//        $p2pkh = new PayToPubKeyHashAddress($pubKeyHash);

//        //Normal address to Segwit
//        echo " * p2pkh address: {$p2pkh->getAddress()}\n"; // normal address 1FCqCvfj5YYZ1qwM2a1ozyJmUnG1BdpS5r
//        $p2wpkhWP = WitnessProgram::v0($publicKey->getPubKeyHash());
//        $p2wpkh = new SegwitAddress($p2wpkhWP);
//        return dd($p2wpkh->getAddress());
//        //

       //$master = $hk->derivePath("0/{$orderid}");
        //$master = $hk->derivePath("m/49/0/0/{$orderid}");
      // return dd($master = $hk->derivePath("m/49'/0'/3'");
//       $address = $master->getPublicKey();
//
//        $orderAddress = $address->getAddress()->getAddress($this->network);
//        return dd($orderAddress);
//
//        //
//
//        $script = ScriptFactory::scriptPubKey()->p2pkh($address->getPubKeyHash());
//        $p2pkh = AddressFactory::fromOutputScript($script);
//        //echo " * p2pkh address: {$p2pkh->getAddress()}\n";
//        $redeemScript = new P2shScript($p2pkh->getScriptPubKey());
//        $p2shAddr = $redeemScript->getAddress();
//        echo " * p2sh: {$p2shAddr->getAddress()}\n";
//        return;
//
//
//        $p2wpkhWP = WitnessProgram::v0($address->getPubKeyHash());
//        $SegwitAddr = New SegwitAddress($p2wpkhWP);
//        return dd(($SegwitAddr)->getAddress());
//        //
//
//        return $orderAddress;
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

