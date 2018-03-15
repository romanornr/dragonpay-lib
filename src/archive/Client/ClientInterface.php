<?php

namespace DragonPay\Client;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Network;
use DragonPay\InvoiceInterface;

interface ClientInterface
{
    const NAME = 'DragonPay PHP-Client';
    const VERSION = '0.1';

   // public function getCurrencies();

    //public function createInvoice(InvoiceInterface $invoice);

   // public function getInvoice($invoiceId);

}
