<?php

namespace Dragonpay;

class Item implements ItemInterface
{
    /**
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
    protected $quantity;

    /**
     * @var bool
     */
    protected $physical;

    public function __construct()
    {
        $this->physical = false;
    }

    /**
     * @inheritdoc
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @inheritdoc
     */
    public function getPrice()
    {
        return $this->price;
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

    public function getQuantity(): integer
    {
        return $$this->quantity;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function isPhysical()
    {
        return $this->physical;
    }


}