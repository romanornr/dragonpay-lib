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
    protected $key_path;

    public function __construct(string $xpub, int $key_path)
    {
        $this->xpub = $xpub;
        $this->key_path = $key_path;
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

        $orderAddress = $this->toAddress($xpub->derivePath("0/{$this->key_path}")); //key_path as childkey
        return $orderAddress->getAddress();
    }

}
