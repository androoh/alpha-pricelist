<?php


namespace App\Resources;


use App\Formly\FormlyFieldConfig;

class Category extends ResourceAbstract
{
    protected static $label = 'Category';
    protected static $model = \App\Models\Category::class;
    protected static $searchBy = ['name'];
    protected static $icon = '<i class="bi bi-bookmark"></i>';

    public function fields($request)
    {
        return [
            new FormlyFieldConfig([
                'key' => 'name',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                'templateOptions' => [
                    'label' => 'Category name',
                    'translatable' => true,
                    'filterable' => true,
                    'required' => true,
                    'showInGrid' => true,
                    'sortable' => true,
                    'flexGrow' => 1
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'description',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA,
                'templateOptions' => [
                    'label' => 'Description',
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'left_page_photo',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Left page photo'
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'right_page_photo',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Right page photo'
                ]
            ]),
        ];
    }
}
