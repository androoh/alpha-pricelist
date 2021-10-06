<?php


namespace App\Fields;


class DynamicSelectModel extends DynamicOptionControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_SELECT = "SELECT";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_SELECT;
    public $filterable;
    public $multiple;
    public $placeholder;
    public $prefix;
    public $suffix;
}
