<?php

namespace DragonPay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DragonPay;

class TransactionController extends Controller
{
    public function test()
    {
        $paymentAddress = DragonPay::createTransactionAddress(1);
        return view('DragonPay::index', ['paymentAddress' => $paymentAddress]);
    }

}
