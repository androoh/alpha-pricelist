<?php


namespace App\Resources;


use App\Formly\FormlyFieldConfig;
use Illuminate\Support\Str;

abstract class ResourceAbstract
{
    protected static $label;
    protected static $model;
    protected static $searchBy;
    protected static $icon;

    abstract public function fields($request);

    public function config($request)
    {
    }

    public function beforeSave($request, $model)
    {
    }

    public function afterSave($request, $model)
    {
    }


    public static function model()
    {
        return static::$model;
    }

    public static function getInfo()
    {
        $classPath = explode('\\', get_called_class());
        return [
            'name' => lcfirst(array_pop($classPath)),
            'label' => static::$label,
            'pluralLabel' => Str::plural(static::$label),
            'searchBy' => static::$searchBy,
            'icon' => static::$icon
        ];
    }

    public function fieldsToArray($request)
    {
        return collect($this->fields($request))->map(function ($obj) {
            return $obj->toArray();
        })->toArray();
    }

    public function getGridColumns($request)
    {
        return (new FormlyFieldConfig())->getGridColumns($this->fields($request));
    }

    public function getFilters($request)
    {
        return (new FormlyFieldConfig())->getFilters($this->fields($request));
    }
}
