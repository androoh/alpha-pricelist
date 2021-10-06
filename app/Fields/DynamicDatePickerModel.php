<?php


namespace App\Fields;


class DynamicDatePickerModel extends DynamicDateControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_DATEPICKER = "DATEPICKER";
    public $autoFocus;
    public $focusedDate;
    public $inline;
    public $prefix;
    public $readOnly;
    public $suffix;
    public $toggleIcon;
    public $toggleLabel;
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_DATEPICKER;

}
