<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;
//use DragonPay\Explorer as BlockExplorer;
use Mockery\Exception;
use DragonPay\BlockExplorers\Litecoin\LitecoinInsightAPI as LitecoinInsightAPI;
use DragonPay\BlockExplorers\InsightAPI;

class TransactionController extends Controller
{
    public function test()
    {
        //$explorer = (new ExplorerManager)->getExplorer(ExplorerManager::BITCOIN)->getAddressTotalReceived('1DEP8i3QJCsomS4BSMY2RpU1upv62aGvhD');
        $test = new LitecoinInsightAPI();
        return dd($test->getAddressTotalReceived('LSZ4GJNnexpFb1oEH1CZB2HWqNsaLXiqS8'));

        //return dd($explorer);
        //dd($explorer->totalReceived('1J7FCFaafPRxqu4X9VsaiMZr1XMemx69GR'));
        //return dd($explorer->getExplorer(ExplorerManager::BITCOIN)->auditTransaction('34qkc2iac6RsyxZVfyE2S5U5WcRsbg2dpK'));

        //return;

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
