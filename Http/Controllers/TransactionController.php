<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;
use DragonPay\BlockExplorer as BlockExplorer;

class TransactionController extends Controller
{
    public function test()
    {
        $blockExplorer = new BlockExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD');
        return dd($blockExplorer->isPaid(4449209));
        $paymentAddress = DragonPay::createTransactionAddress(1);
        $dollarPrice = 1200;
        $cryptoPrice = DragonPay::getBitcoinPrice($dollarPrice);
        $QRcode = DragonPay::createQRcode($paymentAddress, $cryptoPrice);
        return view('DragonPay::index', ['paymentAddress' => $paymentAddress,
                                                'dollarPrice' => $dollarPrice,
                                                'cryptoPrice' => $cryptoPrice,
                                                'QRcode' => $QRcode]);
    }

}
