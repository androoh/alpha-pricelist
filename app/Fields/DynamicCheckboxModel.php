<?php


namespace App\Fields;


class DynamicCheckboxModel extends DynamicCheckControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_CHECKBOX = "CHECKBOX";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_CHECKBOX;
    public $indeterminate = false;
}
