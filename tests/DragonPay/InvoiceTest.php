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

        $this->assertTrue(1 > -1);
        $this->assertNotNull($this->invoice);
        $this->assertNull($this->invoice->getPrice());
    }
}
