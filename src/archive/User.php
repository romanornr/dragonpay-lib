<?php

namespace DragonPay;

/**
 * Class User
 * @package DragonPay
 */
class User implements UserInterface
{
    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var array
     */
    protected $address;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $zip;

    /**
     * @var string
     */
    protected $country;

    /**
     * @var bool
     */
    protected $notify;

    /**
     * @inheritdoc
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return UserInterface
     */
    public function setPhone(string $phone)
    {
        if(!empty($phone) && is_string($phone) && ctype_print($phone)){
            $this->phone = trim($phone);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserInterface
     */
    public function setEmail(string $email): UserInterface
    {
        if (!empty($email) && is_string($email) && ctype_print($email)) {
            $this->email = trim($email);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    /**
     * @param string $firstName
     * @return UserInterface
     */
    public function setFirstName(string $firstName): UserInterface
    {
        if(!empty($firstName) && ctype_print($firstName) && ctype_print($firstName)){
            $this->firstName = trim($firstName);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return UserInterface
     */
    public function setLastName(string $lastName): UserInterface
    {
        if(!empty($lastName) && is_string($lastName) && ctype_print($lastName)){
            $this->lastName = trim($lastName);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param array $address
     * @return UserInterface
     */
    public function setAddress(array $address): UserInterface
    {
        if(!empty($address) && is_array($address)){
            $this->address = $address;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @inheritdoc
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string $state
     * @return UserInterface
     */
    public function setState(string $state): UserInterface
    {
        if(!empty($state) && is_string($state) && ctype_print($state)){
            $this->state = trim($state);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     * @return UserInterface
     */
    public function setZip(string $zip): UserInterface
    {
        if(!empty($zip) && is_string($zip) && ctype_print($zip)){
            $this->zip = trim($zip);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @param string $country
     * @return UserInterface
     */
    public function setCountry(string $country): UserInterface
    {
        if(!empty($country) && is_string($country) && ctype_print($country)){
            $this->country = trim($country);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getNotify(): ?bool
    {
        return $this->notify;
    }

    /**
     * @param bool $boolvalue
     * @return UserInterface
     */
    public function setNotify(bool $boolvalue): UserInterface
    {
        if(!empty($boolvalue)){
            $this->notify = $boolvalue;
        }
        return $this;
    }
}

