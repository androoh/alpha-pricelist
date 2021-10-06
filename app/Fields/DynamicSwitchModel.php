<?php


namespace App\Fields;


class DynamicSwitchModel extends DynamicCheckControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_SWITCH = "SWITCH";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_SWITCH;
    public $offLabel;
    public $onLabel;
}
