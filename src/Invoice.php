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

    protected $status;

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

    public function setCurrency($currency)
    {
        if(!empty($currency)){
            $this->currency = $currency;
        }
        return $this;
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status)
    {
        if(!empty($status) && ctype_print($status)){
            $this->status = trim($status);
        }
        return $this;
    }

    public function getBtcPrice(): string
    {
        // TODO: Implement getBtcPrice() method.
    }

    public function getInvoiceTime(): \DateTime
    {
        return $this->invoiceTime;
    }

    public function setInvoiceTime($invoiceTime)
    {
        if(is_a($invoiceTime, 'DateTime')){
            $this->invoiceTime = $invoiceTime;
        }else if(is_numeric($invoiceTime)){
            $invoiceDateTime = new \DateTime();
            $invoiceDateTime->setTimestamp($invoiceTime);
            $this->invoiceTime = $invoiceDateTime;
        }
        return $this;
    }

    public function getExpirationTime(): \DateTime
    {
        // TODO: Implement getExpirationTime() method.
    }

    public function getCurrentTime(): \DateTime
    {
        // TODO: Implement getCurrentTime() method.
    }

    public function getOrderId(): string
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

    public function getNotificationEmail()
    {
        // TODO: Implement getNotificationEmail() method.
    }

    public function isExtendedNotifications()
    {
        // TODO: Implement isExtendedNotifications() method.
    }

    public function isFullNotifications()
    {
        // TODO: Implement isFullNotifications() method.
    }

    public function getUrl(): string
    {
        // TODO: Implement getUrl() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }
}