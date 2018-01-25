<?php

namespace DragonPay;

interface InvoiceInterface
{
    const STATUS_NEW = 'new';

    const STATUS_CONFIRMED = 'confirmed';

    const STATUS_COMPLETE = 'complete';

    const STATUS_INVALID = 'invalid';

    const TRANSACTION_SPEED_HIGH = 'high';
    const TRANSACTION_SPEED_MEDIUM = 'medium';
    const TRANSACTION_SPEED_LOW    = 'low';

    /**
     * get price in BTC
     *
     * @return float
     */
    public function getPrice();

    public function getCryptoCurrency();

    public function getItem();

    public function getTransactionSpeed();

    public function getNotificationUrl();

    public function getPosData();

    public function getStatus();

    public function getBtcPrice();

    public function getInvoiceTime();

    public function getExpirationTime();

    public function getCurrentTime();

    public function getOrderId();

    public function getItemDescription();

    public function getItemCode();

    public function isPhysical();
}