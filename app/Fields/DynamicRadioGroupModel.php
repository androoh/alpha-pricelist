<?php


namespace App\Fields;


class DynamicRadioGroupModel extends DynamicOptionControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_RADIO_GROUP = "RADIO_GROUP";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_RADIO_GROUP;
    public $legend;
}
