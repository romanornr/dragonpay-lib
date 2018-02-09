<?php

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Script\ScriptFactory;

class LegacyAddress extends Adress
{
    private $xpub;
    private $orderid;

//    public function __construct()
//    {
//        parent::__construct($xpub, $orderid);
//    }

    public function toAddress(HierarchicalKey $key)
    {
        return ScriptFactory::scriptPubKey()->p2pkh($key->getPublicKey()->getPubKeyHash());
    }

    public function createOrderAddress()
    {
        $orderAddress = toAddress($this->xpub->derivePath("0/{$this->orderid}"))->getAddress(); //orderid as childkey
        return $orderAddress;
    }

}