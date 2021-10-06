<?php


namespace App\Fields;


class DynamicSliderModel extends DynamicFormValueControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_SLIDER = "SLIDER";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_SLIDER;
    public $max;
    public $min;
    public $step;
    public $vertical = false;
}
