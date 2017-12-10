<?php

//namespace DragonPay;

interface Observer {
    public function addAddress(Address $address);
}

class BlockExplorer implements Observer {

    protected $minConfirmations = 3;

    private $network;

    private $addresses;

    public function __construct()
    {
        $this->addresses = array();
    }

    public function addAddress(Address $address)
    {
        array_push($this->addresses, $address);
    }

    public function updateTransactionStatus()
    {
        foreach ($this->addresses as $address){
            $address->update();
        }
    }
}

interface Address {
    public function update();
    public function getTransactionStatus();
}

class Bitcoin implements Address {
    private $transactionStatus;

    public function __construct($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    public function update(){
        $this->transactionStatus = $this->getTransactionStatus();
    }

    public function getTransactionStatus()
    {
        echo "bitcoin-paid <br>";
    }

}

class Dash implements Address {
    private $transactionStatus;

    public function __construct($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;
    }

    public function update(){
        $this->transactionStatus = $this->getTransactionStatus();
    }

    public function getTransactionStatus()
    {
        echo "dash-paid <br>";
    }

}

$blockExplorer = new BlockExplorer();
$addr1 = new Bitcoin('1Hz96kJKF2HLPGY15JWLB5m9qGNxvt8tHJ');
$addr2 = new Dash('3196kJKF2HLPGY15JWLB5m9qGNx2222');
$add3 = New Bitcoin('3234444');

$blockExplorer->addAddress($addr1);

$blockExplorer->addAddress($addr2);

$blockExplorer->addAddress($add3);

$blockExplorer->updateTransactionStatus();
echo '<br>';


//$blockExplorer->addAddress($addr2);
//$blockExplorer->transactionPaid();
//$blockExplorer->updateTransactionStatus();
