<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;
use BitWasp\Bitcoin\Network\Network;

abstract class Address
{
    protected $xpub;
    protected $key_path;

    public function _construct(Network $network, string $xpub, int $key_path)
    {
        $this->network = $network;
        $this->xpub = $xpub;
        $this->key_path = $key_path;
    }

    abstract public function toAddress(HierarchicalKey $key);
    abstract public function createOrderAddress();
}