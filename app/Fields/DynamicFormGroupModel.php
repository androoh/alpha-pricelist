<?php


namespace App\Fields;


class DynamicFormGroupModel extends DynamicFormControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_GROUP = "GROUP";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_GROUP;
    public $group;
    public $legend;
}
