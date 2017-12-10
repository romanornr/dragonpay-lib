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
            //$blockExplorer = new BitcoinExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvh');
            //$blockExplorer = new DragonPay\BitcoinExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD');
            $blockExplorer = New DragonPay\DashExplorer('Xico5nigvR8Kk2PQZuthSb5dETUf5oAj8g');
            //return dd($blockExplorer->totalReceived());
        } catch (Exception $e) {

            return 'error'. $e;
        }



        if ($blockExplorer->isConfirmed() && $blockExplorer->totalReceived() > 449  ) {
            return "PAID ! ";
        }

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
