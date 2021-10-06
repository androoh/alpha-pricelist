<?php


namespace App\Fields;


abstract class FormModelAbstract
{
    public function __construct($props)
    {
        foreach ($props as $keyProp => $valueProp) {
            if (property_exists($this, $keyProp)) {
                $this->{$keyProp} = $valueProp;
            }
        }
    }
}
