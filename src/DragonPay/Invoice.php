<?php

namespace DragonPay;

class Invoice implements InvoiceInterface
{
    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * get price in BTC
     *
     * @return float
     */
    public function getPrice()
    {
       // return $this->getItem()->getPrice();
        return 1;
    }

    public function getCryptoCurrency()
    {
        if (!empty($price)) {
            $this->getItem()->setPrice($price);
        }
        return $this;
    }

    public function getItem()
    {
        // TODO: Implement getItem() method.
    }

    public function getTransactionSpeed()
    {
        // TODO: Implement getTransactionSpeed() method.
    }

    public function getNotificationUrl()
    {
        // TODO: Implement getNotificationUrl() method.
    }

    public function getPosData()
    {
        // TODO: Implement getPosData() method.
    }

    public function getStatus()
    {
        // TODO: Implement getStatus() method.
    }

    public function getBtcPrice()
    {
        // TODO: Implement getBtcPrice() method.
    }

    public function getInvoiceTime()
    {
        // TODO: Implement getInvoiceTime() method.
    }

    public function getExpirationTime()
    {
        // TODO: Implement getExpirationTime() method.
    }

    public function getCurrentTime()
    {
        // TODO: Implement getCurrentTime() method.
    }

    public function getOrderId()
    {
        // TODO: Implement getOrderId() method.
    }

    public function getItemDescription()
    {
        // TODO: Implement getItemDescription() method.
    }

    public function getItemCode()
    {
        // TODO: Implement getItemCode() method.
    }

    public function isPhysical()
    {
        // TODO: Implement isPhysical() method.
    }
}