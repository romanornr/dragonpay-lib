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
     * @var ItemInterface
     */
    protected $item;

    /**
     * get price in BTC
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->getItem()->getPrice();
    }

    /**
     * @inheritdoc
     */
    public function setPrice($price)
    {
        if(!empty($price)) {
            $this->getItem()->setPrice($price);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCurrency()
    {
        return $this->currency;
    }


    /**
     * @inheritdoc
     */
    public function getItem()
    {
        if(null == $this->item){
            $this->item = new Item();
        }
        return $this->item;
    }

    /**
     * @param ItemInterface $item
     * @return InvoiceInterface
     */
    public function setItem(ItemInterface $item)
    {
        if(!empty($item)) {
            $this->item = $item;
        }
        return $this;
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