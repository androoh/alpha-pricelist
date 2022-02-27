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
        $defaultLocale = config('app.template.locale', config('app.fallback_locale'));
        $locale = $locale ? $locale : $defaultLocale;
        $localePath = strlen($path) > 0 ? $path . '.' . $locale : $locale;
        $value = data_get($data, $localePath, null);
        if (!$value) {
            $defaultLocale = config('app.fallback_locale');
            $defaultPath = strlen($path) > 0 ? $path . '.' . $defaultLocale : $defaultLocale;
            $value = data_get($data, $defaultPath, null);
            if (!$value) {
                $value = $defaultValue;
            }
        }

        return $value;
    }
}

if (!function_exists('getImagesFromPath')) {
    function getImagesFromPath($data, $path = '', $defaultValue = [], $locale = null) {
        $defaultLocale = config('app.template.locale', config('app.fallback_locale'));
        $locale = $locale ? $locale : $defaultLocale;
        $localePath = strlen($path) > 0 ? $path . '.' . $locale : $locale;
        $value = data_get($data, $localePath, null);
        if (!$value) {
            $defaultLocale = config('app.fallback_locale');
            $defaultPath = strlen($path) > 0 ? $path . '.' . $defaultLocale : $defaultLocale;
            $value = data_get($data, $defaultPath, null);
        }
        if (!$value) {
            $value = data_get($data, $path, $defaultValue);
        }
        return $value;
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
