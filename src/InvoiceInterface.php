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

    /**
     * @return CurrencyInterface
     */
    public function getCurrency();

    /**
     * @return ItemInterface
     */
    public function getItem();

    /**
     * @return BuyerInterface
     */
    public function getBuyer(): BuyerInterface;

    /**
     * @return string
     */
    public function getTransactionSpeed();

    /**
     * will send an email to this email address when the invoice status changes
     * @return string
     */
    public function getNotificationEmail();

    /**
     * a url to send status updates messages to the server. (https)
     * The server will sent a POST request with json encoding of the invoice
     * to this URL when the invoice status changes.
     * @return string
     */
    public function getNotificationUrl();

    /**
     * a passthru variable provided by the marchant and designed to be used
     * by the merchant to correlate the invoice with an order or other object in their system.
     * @return array|object
     */
    public function getPosData();

    /**
     * current invoice status.
     * @return string
     */
    public function getStatus(): ?string ;

    /**
     * default value: true
     * ● true: Notifications will be sent on every status change.
     * ● false: Notifications are only sent when an invoice is confirmed (according
     *   to the “transactionSpeed” setting).
     *
     * @return boolean
     */
    public function isFullNotifications();

    /**
     * default value: false
     * ● true: Notifications will also be sent for expired invoices and refunds.
     * ● false: Notifications will not be sent for expired invoices and refunds
     *
     * @return boolean
     */
    public function isExtendedNotifications();


    /**
     * The unique id of the invoice assigned by the external server.
     * @return string
     */
    public function getId();

    /**
     * a https URL where the invoice can be viewed
     * @return string
     */
    public function getUrl(): string ;

    /**
     * The amount of bitcoins being requested for payment of this invoice
     * @return string
     */
    public function getBtcPrice(): string ;

    /**
     * The time the invoice was created in UNIX time.
     * @return \DateTime
     */
    public function getInvoiceTime(): \DateTime;

    /**
     * The time at which the invoice was expired and no further payments will be
     * accepted.
     * @return \DateTime
     */
    public function getExpirationTime(): \DateTime;

    /**
     * The current time on the external server in UNIX time.
     * @return \DateTime
     */
    public function getCurrentTime(): \DateTime;

    /**
     * Used to display your public order number to the buyer on the external server invoice.
     * @return string
     */
    public function getOrderId(): string;

    /**
     * Used to dispaly an item description to the buyer.
     * @return mixed
     */
    public function getItemDescription();

    /**
     * USed to display an item SKU code or part number to the buyer
     * @return string
     */
    public function getItemCode();

    /**
     * default value: false
     * ● true: Indicates a physical item will be shipped (or picked up)
     * ● false: Indicates that nothing is to be shipped for this order
     *
     * @deprecated
     * @return boolean
     */
    public function isPhysical();
}