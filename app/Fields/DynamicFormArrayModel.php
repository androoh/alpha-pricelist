<?php


namespace App\Fields;


class DynamicFormArrayModel extends DynamicFormControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_ARRAY = "ARRAY";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_ARRAY;
    public $groupAsyncValidators;
    public $groupFactory;
    public $groupValidators;
    public $groups;
    public $initialCount;
    public $groupPrototype;
}
