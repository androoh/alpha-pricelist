<?php

use Illuminate\Support\Facades\Config;

if (!function_exists('currencyFormatType')) {
    function currencyFormatType($formatType) {
        Config::set('money.format_type', $formatType);
    }
}

if (!function_exists('setGlobalCurrency')) {
    function setGlobalCurrency($currency) {
        Config::set('money.defaultCurrency', $currency);
    }
}

if (!function_exists('translateFromPath')) {
    function translateFromPath($data, $path = '', $defaultValue = null, $locale = null) {
        $locale = $locale ? $locale : config('app.template.locale', config('app.locale'));
        $path = strlen($path) > 0 ? $path . '.' . $locale : $locale;
        return data_get($data, $path, $defaultValue);
    }
}

if (!function_exists('getPriceKey')) {
    function getPriceKey($childProduct, $parentProduct = null) {
        $priceKey = $childProduct->getKey();
        if ($parentProduct && $parentProduct->getKey()) {
            $priceKey = $parentProduct->getKey() . '#' . $priceKey;
        }
        return $priceKey;
    }
}
