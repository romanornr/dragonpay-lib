<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;
use DragonPay\Explorer as BlockExplorer;
use Mockery\Exception;

class TransactionController extends Controller
{
    public function test()
    {

//        try {
//            //$blockExplorer = new BitcoinExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvh');
//            //$blockExplorer = new DragonPay\BitcoinExplorer('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD');
//            $blockExplorer = New DragonPay\DashExplorer('Xico5nigvR8Kk2PQZuthSb5dETUf5oAj8g');
//            //return dd($blockExplorer->totalReceived());
//        } catch (Exception $e) {
//
//            return 'error'. $e;
//        }
//
//
//
//        if ($blockExplorer->isConfirmed() && $blockExplorer->totalReceived() > 449  ) {
//            return "PAID ! ";
//        }

        //return dd(\DragonPay\ExplorerManager::BITCOIN);
        $explorer = (new ExplorerManager)->getExplorer(ExplorerManager::BITCOIN);

//dd($explorer->totalReceived('1J7FCFaafPRxqu4X9VsaiMZr1XMemx69GR'));

        //return dd($explorer->getExplorer(ExplorerManager::BITCOIN)->totalReceived('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvh'));

        $paymentAddress = DragonPay::createTransactionAddress(1);
        $dollarPrice = 2;
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
