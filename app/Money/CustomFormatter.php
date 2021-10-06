<?php

namespace App\Money;

use App\Models\Product;
use Illuminate\Support\Facades\Config;

class CustomFormatter implements \Money\MoneyFormatter
{
    private $formatType;

    public function __construct($formatType) {
        $this->formatType = $formatType ?? Product::PRODUCT_PRICE_TYPE_PER_UNIT;
    }
    public function format(\Money\Money $money)
    {
        if ($this->formatType === Product::PRODUCT_PRICE_TYPE_PER_SQM) {
            $locale = Config::get('money.locale', 'en_US');
            return $money->getAmount(). ' '. $this->getCurrencySymbol($money->getCurrency()->getCode(), $locale) . '/㎡';
        }
        return money($money->getAmount() * 100);
    }

    function getCurrencySymbol($currencyCode, $locale = 'en_US')
    {
        $formatter = new \NumberFormatter($locale . '@currency=' . $currencyCode, \NumberFormatter::CURRENCY);
        return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
}
