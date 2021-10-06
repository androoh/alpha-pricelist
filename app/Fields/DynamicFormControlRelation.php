<?php


namespace App\Fields;


class DynamicFormControlRelation extends FormModelAbstract
{
    const MATCH_DISABLED = "DISABLED";
    const MATCH_ENABLED = "ENABLED";
    const MATCH_HIDDEN = "HIDDEN";
    const MATCH_OPTIONAL = "OPTIONAL";
    const MATCH_REQUIRED = "REQUIRED";
    const MATCH_VISIBLE = "VISIBLE";

    const AND_OPERATOR = "AND";
    const OR_OPERATOR = "OR";

    public $match;
    public $operator;
    public $when;
}
