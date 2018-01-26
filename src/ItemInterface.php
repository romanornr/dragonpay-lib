<?php

namespace DragonPay;

interface ItemInterface
{

    /**
     * Used to display an item SKU code or part number to the buyer. Maximum string
     * length is 100 characters.
     *
     * @return string
     */
    public function getCode(): ?string;

    /**
     * Display an item description to the buyer
     *
     * @return string
     */
    public function getDescription(): ?string;

    /**
     * return price
     *
     * @return float
     */
    public function getPrice(): ?float;

    /**
     * get quantity of an item
     *
     * @return integer
     */
    public function getQuantity(): integer;

    /**
     * true: Indicates a physical item will be shipped (or picked up)
     * false: Indicates that nothing is to be shipped for this order
     * 
     * @return boolean
     */
    public function isPhysical(): bool;

}