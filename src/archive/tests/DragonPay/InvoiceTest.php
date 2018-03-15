<?php

namespace DragonPay;

use Illuminate\Validation\Rules\In;
use PHPUnit\Framework\TestCase;
use Dragonpay\Invoice;

class InvoiceTest extends TestCase
{
    public $invoice;

    public function setUp()
    {
        $this->invoice = new \DragonPay\Invoice();
    }
    
    public function testGetPrice()
    {
        $this->assertNotNull($this->invoice);
        $this->assertNull($this->invoice->getPrice());
    }

    /**
     * @depends testGetPrice
     */
    public function testSetPrice()
    {
        $this->assertNotNull($this->invoice);
        $this->invoice->setPrice(9.99);
        $this->assertSame(9.99, $this->invoice->getPrice());
    }
}
