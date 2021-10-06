<?php


namespace App\Fields;


class DynamicInputControlModel extends DynamicFormValueControlModel
{
    public $autoComplete;
    public $autoFocus;
    public $maxLength = 255;
    public $minLength = 0;
    public $placeholder;
    public $prefix;
    public $readOnly;
    public $spellCheck;
    public $suffix;
}
