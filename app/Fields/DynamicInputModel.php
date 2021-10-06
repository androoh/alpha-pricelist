<?php


namespace App\Fields;


class DynamicInputModel extends DynamicInputControlModel
{
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_COLOR = "color";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_DATE = "date";
//  const DYNAMIC_FORM_CONTROL_INPUT_TYPE_DATETIME = "datetime";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_DATETIME_LOCAL = "datetime-local";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_EMAIL = "email";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_FILE = "file";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_MONTH = "month";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_NUMBER = "number";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_PASSWORD = "password";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_RANGE = "range";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_SEARCH = "search";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_TEL = "tel";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_TEXT = "text";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_TIME = "time";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_URL = "url";
    const DYNAMIC_FORM_CONTROL_INPUT_TYPE_WEEK = "week";
    public $type = 'INPUT';
    public $accept;
    public $inputType;
    public $files;
    public $mask;
    public $maskConfig;
    public $max;
    public $min;
    public $multiple;
    public $pattern;
    public $step;
}
