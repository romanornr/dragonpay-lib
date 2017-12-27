<?php
/**
 * Created by PhpStorm.
 * User: romano
 * Date: 12/27/17
 * Time: 9:28 PM
 */

namespace DragonPay\BlockExplorers;
use GuzzleHttp\Client;

interface BlockExplorer
{
    public function getAddressHistory();
    public function getAddressTotalReceived(string $address): int;
}