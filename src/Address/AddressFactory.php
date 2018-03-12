<?php

namespace DragonPay\Address;

use BitWasp\Bitcoin\Network\Network;
use BitWasp\Bitcoin\Network\NetworkFactory;
use DragonPay\CryptoCurrencies\Cryptocurrency;


class AddressFactory
{
    public static function getAddress(Cryptocurrency $cryptocurrency, string $type, string $xpub, int $key_path)
    {
        if(empty($xpub)){
            throw new Exception("No xpub passed");
        }

        $network = $cryptocurrency->getNetwork();

        switch ($type){
            case 'legacy':
                return new LegacyAddress($network, $xpub, $key_path);
                break;
            case 'segwit':
                return new SegwitAddress($network, $xpub, $key_path);
                break;
            default:
                throw new Exception("Type not valid. Choos legacy or segwit");
                break;
        }
    }
}

