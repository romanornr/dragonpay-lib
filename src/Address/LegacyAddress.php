<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Bitcoin\Address\AddressFactory;
use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Script\ScriptFactory;
use BitWasp\Bitcoin\Network\Network;

class LegacyAddress extends Address
{
    protected $xpub;
    protected $key_path;

    public function __construct(Network $network, string $xpub, int $key_path)
    {
        $this->network = $network;
        $this->xpub = $xpub;
        $this->key_path = $key_path;
    }

    public function toAddress(HierarchicalKey $key)
    {
        $script = ScriptFactory::scriptPubKey()->p2pkh($key->getPublicKey()->getPubKeyHash());
        return AddressFactory::fromOutputScript($script);
    }

    public function createOrderAddress()
    {
        $purposePub = $this->xpub;
        $xpub = HierarchicalKeyFactory::fromExtended($purposePub, $this->network);

        $orderAddress = $this->toAddress($xpub->derivePath("0/{$this->key_path}")); //key_path as childkey
        return $orderAddress->getAddress($this->network);
    }

}