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
use App\Models\Order;

use DragonPay\Client;

class TransactionController extends Controller
{
    public function test()
    {
        //$test = new BitcoinInsightAPI();
       // return dd($test->getAddressTotalReceived('17gVZssumiJqYMCHozHKXGyaAvyu6NCX6V'));

        //return dd($explorer);
        //dd($explorer->totalReceived('1J7FCFaafPRxqu4X9VsaiMZr1XMemx69GR'));
        //return dd($explorer->getExplorer(ExplorerManager::BITCOIN)->auditTransaction('34qkc2iac6RsyxZVfyE2S5U5WcRsbg2dpK'));

        $x = new Rates\CryptoCompare();
        $a = $x->fiatIntoSatoshi(10, 'USD', 'VIA');
        return dd($a);

        $d = new \DragonPay\DragonPay();
        $d = DragonPay\Address\AddressFactory::getAddress('segwit', 'xpub6DBfFoZHK5ZCzuoViVTzmRTf91DEVvYoifJQToHhHAwS2pmyeQCfQ5pqCg65WYBB2jnyDtoPRdpLVgwH5UpFswFX1qNtD4ccpZJXB9fqkQA', 2);

    return dd($d->createOrderAddress());

        $d = new DragonPay\Client\Client();
        $invoice = new Invoice();
        $invoice->setPrice(20);
        $item = new Item();
        $item
            ->setCode('skuNumber')
            ->setDescription('General Description of Item')
            ->setPrice('1.99');

        $invoice->setItem($item);

        $buyer = new Buyer();
        $buyer->setEmail('buyeremail@gmail.com');
        $invoice->setBuyer($buyer);
        return dd($d->createInvoice($invoice));

        $paymentAddress = DragonPay::createTransactionAddress(1);
        $dollarPrice = 2;
        $cryptoPrice = DragonPay::getBitcoinPrice($dollarPrice);
        $QRcode = DragonPay::createQRcode($paymentAddress, $cryptoPrice);

        return view('DragonPay::index', ['paymentAddress' => $paymentAddress,
                                                'dollarPrice' => $dollarPrice,
                                                'cryptoPrice' => $cryptoPrice,
                                                'QRcode' => $QRcode]);
    }


    public function transactionPaid()
    {
        $network = 'Bitcoin';
        $blockExplorer = new BitcoinInsightAPI();

        $orders = Order::where('paid', 0)
                ->where('network', $network)
                ->get();

        foreach($orders as $order)
        {
            if($blockExplorer->isPaid($order->paymentAddress, $order->satoshi)){
                $order->paid = 1;
                $order->save();
            };
        }
    }

}
