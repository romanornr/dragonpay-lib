<?php

namespace DragonPay\Address;

class AddressFactory
{
    public static function getAddress(string $xpub, string $type, int $orderid)
    {
        if(empty($xpub)){
            throw new Exception("No xpub passed");
        }

        switch ($type){
            case 'legacy':
                return new LegacyAddress($xpub, $orderid);
                break;
            case 'segwit':
                return new SegwitAdress($xpub, $orderid);
                break;
            default:
                throw new Exception("Type not valid. Choos legacy or segwit");
                break;
        }
    }
}

