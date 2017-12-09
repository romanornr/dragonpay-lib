<?php

//namespace DragonPay;

interface Observer {
    public function addAddress(Address $address);
}

class BlockExplorer implements Observer {

    protected $minConfirmations = 3;

    private $network;

    private $address;

    public function __construct()
    {
        $this->address = array();
    }

    public function addAddress(Address $address)
    {
        array_push($this->address, $address);
    }

    public function transactionPaid()
    {
        //(if blablabal){
         echo "tx paid";
        //}else{
        //echo "unpaid
        //}
    }

    public function getTransactionStatus()
    {
        return [
            'paid' => $this->transactionPaid()
            //'confirmed' => $this->transactionConfirmed($address);
        ];
    }
}

interface Address {
    public function getTransactionStatus();
}

class Bitcoin implements Address {
    private $transactionStatus;

    public function __construct($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    public function getTransactionStatus()
    {
        $this->transactionStatus = $this->getTransactionStatus();
    }

    public function transactionPaid()
    {
        echo 'paid';
    }
}

$blockExplorer = new BlockExplorer();
$addr1 = new Bitcoin('1Hz96kJKF2HLPGY15JWLB5m9qGNxvt8tHJ');

$blockExplorer->addAddress($addr1);
$blockExplorer->transactionPaid();
$blockExplorer->getTransactionStatus();

echo '<br>';

$addr2 = new Bitcoin('3196kJKF2HLPGY15JWLB5m9qGNx2222');
$blockExplorer->addAddress($addr2);
$blockExplorer->getTransactionStatus();
