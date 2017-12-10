<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;
use DragonPay\BlockExplorer as BlockExplorer;
use Mockery\Exception;

class TransactionController extends Controller
{
    public function test()
    {

        try {
            $blockExplorer = new BlockExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvh');
           // return dd($blockExplorer->totalReceived());
        } catch (Exception $e) {

            return 'error'. $e;
        }


       // $blockExplorer->totalReceived() > 449 // ispaid

        //if ($blockExplorer->isConfirmed()) {

        //}

        $paymentAddress = DragonPay::createTransactionAddress(1);
        $dollarPrice = 1200;
        $cryptoPrice = DragonPay::getBitcoinPrice($dollarPrice);
        $QRcode = DragonPay::createQRcode($paymentAddress, $cryptoPrice);
        return view('DragonPay::index', ['paymentAddress' => $paymentAddress,
                                                'dollarPrice' => $dollarPrice,
                                                'cryptoPrice' => $cryptoPrice,
                                                'QRcode' => $QRcode]);
    }


    private function transactionPaid($transactionId)
    {

    }

}
