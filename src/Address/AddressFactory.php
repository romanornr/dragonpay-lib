<?php

namespace DragonPay\Address;

class AddressFactory
{
    public static function getAddress(string $type, string $xpub, int $key_path)
    {
        if(empty($xpub)){
            throw new Exception("No xpub passed");
        }

        switch ($type){
            case 'legacy':
                return new LegacyAddress($xpub, $key_path);
                break;
            case 'segwit':
                return new SegwitAddress($xpub, $key_path);
                break;
            default:
                throw new Exception("Type not valid. Choos legacy or segwit");
                break;
        }
    }
}

