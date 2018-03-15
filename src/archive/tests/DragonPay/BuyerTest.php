<?php

namespace DragonPay;

use PHPUnit\Framework\TestCase;

/**
 * Class BuyerTest
 * @package DragonPay
 */
class BuyerTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new Buyer();
    }


    public function testGetEmail()
    {
        $this->AssertNotNull($this->user);
        $this->assertNull($this->user->getEmail());
    }

    public function testSetEmail()
    {
        $this->assertNotNull($this->user);
        $this->user->setEmail('test@gmail.com');
        $this->assertSame('test@gmail.com', $this->user->getEmail());
    }
}