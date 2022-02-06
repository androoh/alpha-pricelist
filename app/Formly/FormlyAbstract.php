<?php


namespace App\Formly;


class FormlyAbstract
{
    public function __construct($props = [])
    {
        foreach ($props as $keyProp => $valueProp) {
            if (property_exists($this, $keyProp)) {
                $this->{$keyProp} = $valueProp;
            }
        }
    }

    public function toArray($object = null, $path = [])
    {
        $data = [];
        $convertedObject = $object ?? $this;
        if ($convertedObject && is_object($convertedObject)) {
            if (property_exists($convertedObject, 'key')) {
                $path[] = $convertedObject->key;
            }
            foreach (get_object_vars($convertedObject) as $key => $value) {
                if (isset($convertedObject->{$key}) && $convertedObject->{$key}) {
                    if (is_object($convertedObject->{$key}) || is_array($convertedObject->{$key})) {
                        $data[$key] = $this->toArray($convertedObject->{$key}, $path);
                    } elseif($convertedObject->{$key}) {
                        $data[$key] = $convertedObject->{$key};
                    }
                }
            }
        } elseif ($convertedObject && is_array($convertedObject)) {
            if (isset($convertedObject['key'])) {
                $path[] = $convertedObject['key'];
            }
            foreach ($convertedObject as $key => $value) {
                if ($value && (is_object($value) || is_array($value))) {
                    $data[$key] = $this->toArray($value, $path);
                } elseif($value) {
                    $data[$key] = $value;
                }
            }
        }
        if (isset($data['key'])) {
            $data['path'] = $path;
        }
        return $data;
    }

    public function getGridColumns($object = null, &$data = [], $path = [])
    {
        return $this->searchInTree($object, function($convertedObject) {
            return property_exists($convertedObject, 'templateOptions')
                && isset($convertedObject->templateOptions['showInGrid'])
                && $convertedObject->templateOptions['showInGrid'] === true;
        });
    }


    public function getFilters($object = null, &$data = [], $path = [])
    {
        return $this->toArray($this->searchInTree($object, function($convertedObject) {
            return property_exists($convertedObject, 'templateOptions')
                && isset($convertedObject->templateOptions['filterable'])
                && $convertedObject->templateOptions['filterable'] === true;
        }));
    }

    public function searchInTree($object = null, callable $callback, &$data = [], $path = [])
    {
        $convertedObject = $object ?? $this;
        if (is_object($convertedObject)) {
            if ($convertedObject instanceof FormlyFieldConfig) {
                if ($convertedObject->fieldArray) {
                    $path[] = $convertedObject->key;
                    if (is_array($convertedObject->fieldArray)) {
                        $this->searchInTree($convertedObject->fieldArray, $callback, $data, $path);
                    } elseif (
                        is_object($convertedObject->fieldArray)
                        && $convertedObject->fieldArray instanceof FormlyFieldConfig
                        && $convertedObject->fieldArray->fieldGroup
                    ) {
                        $this->searchInTree($convertedObject->fieldArray->fieldGroup, $callback, $data, $path);
                    }
                } elseif ($convertedObject->fieldGroup) {
                    $path[] = $convertedObject->key;
                    $this->searchInTree($convertedObject->fieldGroup, $callback, $data, $path);
                } else {
                    // you can throw any logic here
                    if (
                        $callback($convertedObject)
                    ) {
                        $path[] = $convertedObject->key;
                        $convertedObject->path = $path ? implode('.', $path) : '';
                        return $convertedObject;
                    }
                }
            }
            return null;
        } elseif (is_array($convertedObject)) {
            foreach ($convertedObject as $item) {
                if ($item instanceof FormlyFieldConfig) {
                    if ($newPath = $this->searchInTree($item, $callback, $data, $path)) {
                        $data[] = $newPath;
                    }
                }
            }
            return $data;
        }

    }
}
