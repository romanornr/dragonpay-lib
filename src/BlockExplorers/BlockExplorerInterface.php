<?php

namespace DragonPay\BlockExplorers;
use GuzzleHttp\Client;

interface BlockExplorerInterface
{
    public function getAddressHistory();
    public function getAddressTotalReceived(string $address): int;
    public function isPaid(string $address, int $satoshi): bool;
}