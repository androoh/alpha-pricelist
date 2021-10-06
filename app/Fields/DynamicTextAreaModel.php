<?php


namespace App\Fields;


class DynamicTextAreaModel extends DynamicInputControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_TEXTAREA = "TEXTAREA";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_TEXTAREA;
    public $cols;
    public $rows;
    public $wrap;
}
