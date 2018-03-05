<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKey;

abstract class Address
{
    protected $xpub;
    protected $key_path;

    public function _construct(string $xpub, int $key_path)
    {
        $this->xpub = $xpub;
        $this->key_path = $key_path;
    }

    abstract public function toAddress(HierarchicalKey $key);
    abstract public function createOrderAddress();
}