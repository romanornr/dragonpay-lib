<?php

namespace DragonPay;

use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    private $currency;

    public function setUp()
    {
        $this->currency = new Currency();
    }

    public function testGetCode()
    {
        $this->assertNotNull($this->currency);
        $this->assertNull($this->currency->getCode());
    }

    /**
     * @depends testGetCode
     */
    public function testSetCode()
    {
        $this->assertNotNull($this->currency);
        $this->currency->setCode('usd');
        $this->assertSame('USD', $this->currency->getCode());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetCodeWithExceptionThrown()
    {
        new Currency('Dogecoidn');
    }

    /**
     * @depends testSetCode
     * @depends testSetCodeWithExceptionThrown
     */
    public function testConstruct()
    {
        $currency = new Currency('usd');
        $this->assertSame('USD', $currency->getCode());
    }


    public function testGetSymbol()
    {
        $this->assertNotNull($this->currency);
        $this->assertNull($this->currency->getSymbol());
    }

    /**
     * @depends testGetSymbol
     */
     public function testSetSymbol()
     {
         $this->assertNotNull($this->currency);
         $this->currency->setSymbol('$');
         $this->assertSame('$', $this->currency->getSymbol());
     }

     public function testGetPrecision()
     {
         $this->assertNotNull($this->currency);
         $this->assertNull($this->currency->getPrecision());
     }

    /**
     * @depends testGetPrecision
     */
    public function testSetPrecision()
    {
        $this->assertNotNull($this->currency);
        $this->currency->setPrecision(2);
        $this->assertSame(2, $this->currency->getPrecision());
    }

    public function testGetExchangePercentageFee()
    {
        $this->assertNotNull($this->currency);
        $this->assertNull($this->currency->getExchangePercentageFee());
    }

    /**
     * @depends testGetExchangePercentageFee
     */
     public function testSetExchangePercentageFee()
     {
         $this->assertNotNull($this->currency);
         $this->currency->setExchangePercentageFee(('100'));
         $this->assertSame('100', $this->currency->getExchangePercentageFee());
     }


     public function testIsPayoutEnabled()
     {
         $this->assertNotNull($this->currency);
         $this->assertFalse($this->currency->isPayoutEnabled());
     }

    /**
     * @depends testIsPayoutEnabled
     */
     public function testSetPayoutEnabled()
     {
         $this->assertNotNull($this->currency);
         $this->currency->setPayoutEnabled(true);
         $this->assertTrue($this->currency->isPayoutEnabled());
     }

     public function testGetName()
     {
         $this->assertNotNull($this->currency);
         $this->assertNull($this->currency->getName());
     }

    /**
     * @depends testGetName
     */
     public function testSetName()
     {
         $this->assertNotNull($this->currency);
         $this->currency->setName('US Dollar');
         $this->assertSame('US Dollar', $this->currency->getName());
     }

    public function testGetPluralName()
    {
        $this->assertNotNull($this->currency);
        $this->assertNull($this->currency->getPluralName());
    }

    /**
     * @depends testGetPluralName
     */
    public function testSetPluralName()
    {
        $this->assertNotNull($this->currency);
        $this->currency->setPluralName('US Dollars');
        $this->assertSame('US Dollars', $this->currency->getPluralName());
    }


    public function testGetAlts()
    {
        $this->assertNotNull($this->currency);
        $this->assertNull($this->currency->getAlts());
    }

    /**
     * @depends testGetAlts
     */
    public function testSetAlts()
    {
        $this->assertNotNull($this->currency);
        $this->currency->setAlts('Litecoin');
        $this->assertSame('Litecoin', $this->currency->getAlts());
    }

    public function testGetPayoutFields()
    {
        $this->assertNotNull($this->currency);
        $this->assertEmpty($this->currency->getPayoutFields());
    }

    /*
     * @depends testGetPayOutFields
     */
    public function testSetPayoutFields()
    {
        $this->assertNotNull($this->currency);

        $fields = [
            'name',
            'accout',
            'routing',
            'merchantEIN'
        ];

        $this->currency->setPayoutFields($fields);
        $this->assertSame($fields, $this->currency->getPayoutFields());
    }


}
