<?php

abstract class Address
{
    protected $xpub;
    protected $orderid;

    public function _construct(string $xpub, int $orderid)
    {
        $this->xpub = $xpub;
        $this->orderid = $orderid;
    }

    abstract public function toAddress(HierarchicalKey $key);
    abstract public function createOrderAddress();
}