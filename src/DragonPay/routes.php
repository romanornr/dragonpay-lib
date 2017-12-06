<?php

Route::get('demo', function(){
    return view('DragonPay::index');
});

Route::get('demo2', 'DragonPay\TransactionController@test');