<?php


namespace App\Resources;


use App\Formly\FormlyFieldConfig;

class InfoIcon extends ResourceAbstract
{
    protected static $label = 'Info Icon';
    protected static $model = \App\Models\InfoIcon::class;
    protected static $searchBy = ['name'];
    protected static $icon = '<i class="bi bi-info-circle"></i>';

    public function fields($request)
    {
        return [
            new FormlyFieldConfig([
                'key' => 'name',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Info icon name',
                    'filterable' => true,
                    'translatable' => true,
                    'required' => true,
                    'showInGrid' => true,
                    'sortable' => true,
                    'flexGrow' => 1
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'description',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Description',
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'iconPhoto',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Icon photo'
                ]
            ]),
        ];
    }
}
