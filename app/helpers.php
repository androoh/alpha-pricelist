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
    function getPriceKey(...$modelsKeys) {
        $result = [];
        foreach ($modelsKeys as $modelKey) {
            if (is_string($modelKey)) {
                array_push($result, $modelKey);
            } else if ($modelKey && $modelKey->getKey()) {
                array_push($result, $modelKey->getKey());
            }
        }
        return implode('#', $result);
    }
}
