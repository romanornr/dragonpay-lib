<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Script\P2shScript;
use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Address\AddressFactory;

class SegwitAddress extends Address
{
    protected $xpub;
    protected $orderid;

    public function __construct(string $xpub, int $orderid)
    {
        $this->xpub = $xpub;
        $this->orderid = $orderid;
    }

    public function toAddress(HierarchicalKey $key)
    {
        $rs = new P2shScript(ScriptFactory::scriptPubKey()->p2wkh($key->getPublicKey()->getPubKeyHash()));
        $script = $rs->getOutputScript();
        return AddressFactory::fromOutputScript($script);
    }

    public function createOrderAddress()
    {
        $purposePub = $this->xpub;
        $xpub = HierarchicalKeyFactory::fromExtended($purposePub);

        $orderAddress = $this->toAddress($xpub->derivePath("0/{$this->orderid}")); //orderid as childkey
        return $orderAddress->getAddress();
    }

}
