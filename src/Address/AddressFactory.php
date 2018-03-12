<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Network\NetworkFactory;
use DragonPay\CryptoCurrencies\Cryptocurrency;

class AddressFactory
{
    public static function getAddress(Cryptocurrency $cryptocurrency, string $type, string $xpub, int $key_path)
    {
        if(empty($xpub)){
            throw new Exception("No xpub passed");
        }

        return dd($cryptocurrency->getNetwork());

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

