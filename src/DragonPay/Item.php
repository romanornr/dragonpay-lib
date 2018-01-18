<?php

namespace DragonPay;

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
    protected $price;

    /**
     * @var float
     */
    protected $quantity;

    /**
     * @var boolean
     */
    protected $physical;

    public function __construct()
    {
        $this->physical = false;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code): string
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param $description
     * @return ItemInterface
     */
    public function setDescription($description): string
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param $price
     * @return ItemInterface
     */
    public function setPrice($price): float
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity): integer
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isPhysical()
    {
        return $this->physical;
    }

    /**
     * @param boolean $physical
     *
     * @return ItemInterface
     */
    public function setPhysical($physical)
    {
        $this->physical = (boolean)$physical;
        return $this;
    }
}