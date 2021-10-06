<?php


namespace App\Fields;


class DynamicHasManyModel extends DynamicFormValueControlModel
{
    const DYNAMIC_FORM_CONTROL_TYPE_HAS_MANY = "HAS_MANY";
    public $type = self::DYNAMIC_FORM_CONTROL_TYPE_HAS_MANY;
    public $resource;
    public $filter;
    public $showFields;
}
