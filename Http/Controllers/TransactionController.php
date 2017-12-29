<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;
//use DragonPay\Explorer as BlockExplorer;
use Mockery\Exception;
use DragonPay\BlockExplorers\Litecoin\LitecoinInsightAPI as LitecoinInsightAPI;
use DragonPay\BlockExplorers\Bitcoin\BitcoinInsightAPI;
use DragonPay\BlockExplorers\InsightAPI;

class TransactionController extends Controller
{
    public function test()
    {
        $test = new BitcoinInsightAPI();
        return dd($test->getAddressTotalReceived('17gVZssumiJqYMCHozHKXGyaAvyu6NCX6V'));

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
