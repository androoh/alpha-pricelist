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
        $locale = Config::get('money.locale', 'en_US');
        $currency = $this->getCurrencySymbol($money->getCurrency()->getCode(), $locale);
        $floatAmount = number_format($money->getAmount()/100, 2);
        if ($this->formatType === Product::PRODUCT_PRICE_TYPE_PER_SQM) {
            return $floatAmount. ' '. $currency . '/㎡';
        }
        if ($this->formatType === Product::PRODUCT_PRICE_TYPE_KG) {
            return $floatAmount. ' '. $currency . '/kg';
        }
        if ($this->formatType === Product::PRODUCT_PRICE_TYPE_LM) {
            return $floatAmount. ' '. $currency . '/m';
        }
        if ($this->formatType === Product::PRODUCT_PRICE_TYPE_RM) {
            return $floatAmount. ' '. $currency . '/rm';
        }
        return money($money->getAmount());
    }

    function getCurrencySymbol($currencyCode, $locale = 'en_US')
    {
        $formatter = new \NumberFormatter($locale . '@currency=' . $currencyCode, \NumberFormatter::CURRENCY);
        return $formatter->getSymbol(\NumberFormatter::CURRENCY_SYMBOL);
    }
}
