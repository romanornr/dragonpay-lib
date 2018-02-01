<?php

namespace DragonPay;

use Exception;

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
     * @var float
     */
    protected $price;

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
    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return IntervoiceInterface
     */
    public function setPrice($price)
    {
        if(is_string($price)){
            $this->checkPriceFormat($price);
        }
        $this->price = (float)$price;
        return $this;
    }

    /**
     * @return ItemInterface
     */
    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity)
    {
        return $this->quantity = (integer)$quantity;
        return $this;
    }


    /**
     * @param boolean $physical
     * @return ItemInterface
     */
    public function isPhysical(): bool
    {
        return $this->physical;
    }

    /**
     * @param boolean $physical
     * @return ItemInterface
     */
    public function setPhysical($physical)
    {
        $this->physical = (boolean)$physical;
        return $this;
    }

    /**
     * Checks the new price for 0
     * @param $price
     * @throws Exception
     */
    protected function checkPriceFormat($price)
    {
        if($price === '0' || $price == '.0')
            return;
        $converted = (float)$price;
        if($converted == 0 || is_float($converted) == false)
            throw new \InvalidArgumentException("Price must be formatted as a float ". $converted);
    }

}