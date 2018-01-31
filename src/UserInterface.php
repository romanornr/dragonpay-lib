<?php

namespace DragonPay;

/**
 * Interface UserInterface
 * @package DragonPay
 */
interface UserInterface
{
    /**
     * @return null|string
     */
    public function getPhone(): ?string;

    /**
     * @return null|string
     */
    public function getEmail(): ?string ;

    /**
     * @return null|string
     */
    public function getFirstName(): ?string;

    /**
     * @return null|string
     */
    public function getLastName(): ?string;

    /**
     * @return null|string
     */
    public function getAddress(): ?string;

    /**
     * @return null|string
     */
    public function getState(): ?string;

    /**
     * @return null|string
     */
    public function getZip(): ?string;

    /**
     * @return null|string
     */
    public function getCountry(): ?string;

    /**
     * @return bool|null
     */
    public function getNotify(): ?bool;
}

