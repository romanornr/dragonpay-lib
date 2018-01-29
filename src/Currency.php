<?php

namespace DragonPay;

class Currency implements CurrencyInterface
{

    /**
     * @var array
     */
    protected static $availableCurrencies = [
        'BTC', 'AED', 'AFN', 'ALL', 'AMD', 'ANG', 'AOA', 'ARS', 'AUD', 'AWG',
        'AZN', 'BAM', 'BBD', 'BDT', 'BGN', 'BHD', 'BIF', 'BMD', 'BND', 'BOB',
        'BRL', 'BSD', 'BTN', 'BWP', 'BYR', 'BZD', 'CAD', 'CDF', 'CHF', 'CLF',
        'CLP', 'CNY', 'COP', 'CRC', 'CVE', 'CZK', 'DJF', 'DKK', 'DOP', 'DZD',
        'EEK', 'EGP', 'ERN', 'ETB', 'EUR', 'FJD', 'FKP', 'GBP', 'GEL', 'GHS',
        'GIP', 'GMD', 'GNF', 'GTQ', 'GYD', 'HKD', 'HNL', 'HRK', 'HTG', 'HUF',
        'IDR', 'ILS', 'INR', 'IQD', 'ISK', 'JEP', 'JMD', 'JOD', 'JPY', 'KES',
        'KGS', 'KHR', 'KMF', 'KRW', 'KWD', 'KYD', 'KZT', 'LAK', 'LBP', 'LKR',
        'LRD', 'LSL', 'LTL', 'LVL', 'LYD', 'MAD', 'MDL', 'MGA', 'MKD', 'MMK',
        'MNT', 'MOP', 'MRO', 'MUR', 'MVR', 'MWK', 'MXN', 'MYR', 'MZN', 'NAD',
        'NGN', 'NIO', 'NOK', 'NPR', 'NZD', 'OMR', 'PAB', 'PEN', 'PGK', 'PHP',
        'PKR', 'PLN', 'PYG', 'QAR', 'RON', 'RSD', 'RUB', 'RWF', 'SAR', 'SBD',
        'SCR', 'SDG', 'SEK', 'SGD', 'SHP', 'SLL', 'SOS', 'SRD', 'STD', 'SVC',
        'SYP', 'SZL', 'THB', 'TJS', 'TMT', 'TND', 'TOP', 'TRY', 'TTD', 'TWD',
        'TZS', 'UAH', 'UGX', 'USD', 'UYU', 'UZS', 'VEF', 'VND', 'VUV', 'WST',
        'XAF', 'XAG', 'XAU', 'XCD', 'XOF', 'XPF', 'YER', 'ZAR', 'ZMW', 'ZWL',
        'CUP', 'IRR', 'KPW'
    ];


    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * @var integer
     */
    protected $precision;

    /**
     * @var string
     */
    protected $exchangePercentageFee;

    /**
     * @var boolean
     */
    protected $payoutEnabled;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $pluralName;

    /**
     * @var array
     */
    protected $alts;

    /**
     * @var array
     */
    protected $payoutFields;

    public function __construct($code = null)
    {
        If(null !== $code) $this->setCode($code);

        $this->payoutEnabled = false;
        $this->payoutFields = array();
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
        if(null !== $code && !in_array(strtoupper($code), self::$availableCurrencies)){
            throw new \InvalidArgumentException(sprintf('The currency of "%s" is not supported.', $code));
        }

        $this->code = strtoupper($code);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSymbol(): ?string
    {
        return $this->symbol;
    }

    /**
     * @param string $sybmbol
     * @return CurrencyInterface
     */
    public function setSymbol(string $symbol)
    {
        if(!empty($symbol) && ctype_print($symbol)){
            $this->symbol = trim($symbol);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPrecision(): ?int
    {
        return $this->precision;
    }

    /**
     * @param integer $precision
     * @return CurrencyInterface
     */
    public function setPrecision(int $precision)
    {
        if(!empty($precision) && ctype_digit(strval($precision))){
            $this->precision = (int) $precision;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getExchangePercentageFee(): ?string
    {
        return $this->exchangePercentageFee;
    }

    /**
     * @param string $fee
     * @return CurrencyInterface
     */
    public function setExchangePercentageFee(string $fee)
    {
        if(!empty($fee) && ctype_print($fee)){
            $this->exchangePercentageFee = trim($fee);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isPayoutEnabled(): bool
    {
        return $this->payoutEnabled;
    }

    /**
     * @param boolean $enabled
     *
     * @return CurrencyInterface
     */
    public function setPayoutEnabled($enabled)
    {
        $this->payoutEnabled = (boolean) $enabled;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CurrencyInterface
     */
    public function setName(string $name)
    {
        if(!empty($name) && ctype_print($name)){
            $this->name = trim($name);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPluralName(): ?string
    {
        return $this->pluralName;
    }

    /**
     * @param string $pluralName
     *
     * @return CurrencyInterface
     */
    public function setPluralName(string $pluralName)
    {
        if (!empty($pluralName) && ctype_print($pluralName)) {
            $this->pluralName = trim($pluralName);
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getAlts()
    {
        return $this->alts;
    }

    /**
     * @param array $alts
     * @return CurrencyInterface
     */
    public function setAlts($alts)
    {
        $this->alts = $alts;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPayoutFields(): array
    {
        return $this->payoutFields;
    }

    /**
     * @param array $payoutFields
     * @return CurrencyInterface
     */
    public function setPayoutFields(array $payoutFields)
    {
        $this->payoutFields = $payoutFields;
        return $this;
    }

}
