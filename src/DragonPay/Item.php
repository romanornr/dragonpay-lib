<?php

namespace Dragonpay;

class Item implements IntemInterface
{
    /**
     * Undocumented variable
     *
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $transactionSpeed = self::TRANSACTION_SPEED_MEDIUM;

    /**
     * @var string
     */
    protected $notificationEmail;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var string
     */
    protected $redirectUrl;

    /*
     * @var string
     */
    protected $posData;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var bool
     */
    protected $fullNotifications = true;

    /**
     * @var bool
     */
    protected $extendedNotificatopns = false;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var float
     */
    protected $btcPrice;

    /**
     * @var \DateTime
     */
    protected $invoiceTime;

    /**
     * @var DateTime
     */
    protected $currentTime;

    /**
     * @var BuyerInterface
     */
    protected $buyer;

    protected $exceptionStatus;

    /**
     * @var
     */
    protected $btcPaid;

    /**
     * @var
     */
    protected $rate;

    /**
     * @var
     */
    protected $token;

    /**
     * @var array
     */
    protected $refundAddresses;

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->getItem()->getPrice();
    }

    /**
     * @param float $price
     * @return IntervoiceInterface
     */
    public function setPrice($price): float
    {
        if(!empty($price)){
            $this->getItem()->setPrice($price);
        }
        return $this;
    }
}