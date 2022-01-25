<?php


namespace App\Resources;

use App\Formly\FormlyFieldConfig;

class Product extends ResourceAbstract
{
    protected static $label = 'Product';
    protected static $model = \App\Models\Product::class;
    protected static $searchBy = ['name'];
    protected static $icon = '<i class="bi bi-box"></i>';


    public function fields($request)
    {
        return [
            new FormlyFieldConfig([
                'key' => 'name',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Product name',
                    'translatable' => true,
                    'required' => true,
                    'sortable' => true,
                    'showInGrid' => true,
                    'filterable' => true
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'sku',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                'templateOptions' => [
                    'label' => 'SKU',
                    'required' => true,
                    'showInGrid' => true,
                    'filterable' => true
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'type',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'templateOptions' => [
                    'label' => 'Product Type',
                    'required' => true,
                    'showInGrid' => true,
                    'filterable' => true,
                    'placeholder' => 'Select Product Type',
                    'options' => [
                        [
                            'label' => 'Main Product',
                            'value' => \App\Models\Product::PRODUCT_TYPE_MAIN
                        ],
                        [
                            'label' => 'Product Model',
                            'value' => \App\Models\Product::PRODUCT_TYPE_MODEL
                        ],
                        [
                            'label' => 'Product Option',
                            'value' => \App\Models\Product::PRODUCT_TYPE_OPTION
                        ]
                    ]
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'price_options',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Price options'
                ],
                'hideExpression' =>
                    "field.parent.model.type === '" . \App\Models\Product::PRODUCT_TYPE_MAIN . "' || "
                    . "field.parent.model.type === undefined",
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'default_price',
                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                        'defaultValue' => '0.0',
                        'templateOptions' => [
                            'label' => 'Default Price',
                            'required' => true,
                            'type' => 'number'
                        ],
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'type',
                        'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                        'defaultValue' => \App\Models\Product::PRODUCT_PRICE_TYPE_PER_UNIT,
                        'templateOptions' => [
                            'label' => 'Pricing Type',
                            'required' => true,
                            'options' => [
                                [
                                    'label' => 'Price per unit',
                                    'value' => \App\Models\Product::PRODUCT_PRICE_TYPE_PER_UNIT
                                ],
                                [
                                    'label' => 'Price per squared meter',
                                    'value' => \App\Models\Product::PRODUCT_PRICE_TYPE_PER_SQM
                                ],
                                [
                                    'label' => 'Price per linear meter',
                                    'value' => \App\Models\Product::PRODUCT_PRICE_TYPE_LM
                                ],
                                [
                                    'label' => 'Price per running meter',
                                    'value' => \App\Models\Product::PRODUCT_PRICE_TYPE_RM
                                ],
                                [
                                    'label' => 'Price per kg',
                                    'value' => \App\Models\Product::PRODUCT_PRICE_TYPE_KG
                                ],
                            ]
                        ],
                    ]),
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'mainProductFields',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Main Product Fields'
                ],
                'hideExpression' => "field.parent.model.type !== '" . \App\Models\Product::PRODUCT_TYPE_MAIN . "'",
                'fieldGroup' => $this->getMainProductFields($request)
            ]),
            new FormlyFieldConfig([
                'key' => 'modelProductFields',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Product Model Fields'
                ],
                'hideExpression' => "field.parent.model.type !== '" . \App\Models\Product::PRODUCT_TYPE_MODEL . "'",
                'fieldGroup' => $this->getProductModelFields($request)
            ]),
            new FormlyFieldConfig([
                'key' => 'optionProductFields',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Product Option Fields'
                ],
                'hideExpression' => "field.parent.model.type !== '" . \App\Models\Product::PRODUCT_TYPE_OPTION . "'",
                'fieldGroup' => $this->getProductOptionFields($request)
            ])
        ];
    }


    private function getMainProductFields($request)
    {
        $categories = \App\Models\Category::all()->map(function ($category) {
            return [
                'label' => translateFromPath($category->name),
                'value' => $category->getKey()
            ];
        })->toArray();
        $infoIcons = \App\Models\InfoIcon::all()->map(function ($infoIcon) {
            return [
                'label' => translateFromPath($infoIcon->name),
                'value' => $infoIcon->getKey()
            ];
        })->toArray();
        return [
            new FormlyFieldConfig([
                'key' => 'category',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'templateOptions' => [
                    'label' => 'Category',
                    'required' => true,
                    'options' => $categories,
                    'placeholder' => 'Please select category'
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'info_icons',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'templateOptions' => [
                    'label' => 'Info icons',
                    'multiple' => true,
                    'options' => $infoIcons,
                    'placeholder' => 'Please select info icons'
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'complexity',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'defaultValue' => 'Basic',
                'templateOptions' => [
                    'label' => 'Complexity',
                    'required' => true,
                    'options' => [
                        [
                            'label' => 'Basic',
                            'value' => 'Basic'
                        ],
                        [
                            'label' => 'Advanced',
                            'value' => 'Advanced'
                        ],
                        [
                            'label' => 'Premium',
                            'value' => 'Premium'
                        ]
                    ]
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'main_photo',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Main Photo',
                    'accept' => ['image/*']
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'main_photo_info_note',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Main Photo Info Note',
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'standard_equipment',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Standard Equipment',
                    'html' => true,
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'info_note',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Info Note',
                    'html' => true,
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'client_suply',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'The client to suply',
                    'html' => true,
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'footer_notes',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Footer Notes',
                    'html' => true,
                    'translatable' => true,
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'awards_photos',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Awards Photos',
                    'accept' => ['image/*'],
                    'multiple' => true
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'product_models',
                'type' => FormlyFieldConfig::FIELD_TYPE_HAS_MANY,
                'templateOptions' => [
                    'label' => 'Product Models',
                    'resource' => 'product',
                    'displayColumnLabel' => 'Product name',
                    'displayColumn' => 'name',
                    'searchBy' => ['name.' . config('app.locale'), 'sku'],
                    'filter' => [
                        'column' => 'type',
                        'comparator' => '=',
                        'value' => \App\Models\Product::PRODUCT_TYPE_MODEL
                    ]
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'product_sections',
                'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                'templateOptions' => [
                    'label' => 'Product Sections',
                    'addText' => 'Add Product Section',
                ],
                'fieldArray' => new FormlyFieldConfig([
                    'fieldGroup' => [
                        new FormlyFieldConfig([
                            'key' => 'title',
                            'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                            'templateOptions' => [
                                'label' => 'Title',
                                'translatable' => true,
                                'required' => true,
                            ]
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'hideTitle',
                            'type' => FormlyFieldConfig::FIELD_TYPE_CHECKBOX,
                            'templateOptions' => [
                                'label' => 'Hide section title'
                            ]
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'layout',
                            'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                            'defaultValue' => 'layout1',
                            'wrappers' => ['layout'],
                            'templateOptions' => [
                                'label' => 'Section Layout',
                                'options' => $this->generateLayoutOptions(),
                                'required' => true
                            ],
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'photo_gallery',
                            'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                            'templateOptions' => [
                                'label' => 'Photo gallery',
                                'accept' => ['image/*'],
                                'multiple' => true
                            ]
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'info_note',
                            'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                            'templateOptions' => [
                                'label' => 'Info Note',
                                'html' => true,
                                'translatable' => true,
                            ]
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'product_option_sections',
                            'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                            'templateOptions' => [
                                'label' => 'Product Option Sections',
                                'addText' => 'Add Product Option Section',
                            ],
                            'fieldArray' => new FormlyFieldConfig([
                                'fieldGroup' => [
                                    new FormlyFieldConfig([
                                        'key' => 'title',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                                        'templateOptions' => [
                                            'label' => 'Title',
                                            'translatable' => true,
                                            'required' => true
                                        ]
                                    ]),
                                    new FormlyFieldConfig([
                                        'key' => 'titleDisplayType',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                                        'defaultValue' => 'title',
                                        'templateOptions' => [
                                            'label' => 'Product Option Title display as',
                                            'required' => true,
                                            'placeholder' => 'Select Display Type',
                                            'options' => [
                                                [
                                                    'label' => 'Display Title',
                                                    'value' => 'title'
                                                ],
                                                [
                                                    'label' => 'Display Photo',
                                                    'value' => 'photo'
                                                ],
                                                [
                                                    'label' => 'Display Description',
                                                    'value' => 'description'
                                                ]
                                            ]
                                        ],
                                    ]),
                                    // new FormlyFieldConfig([
                                    //     'key' => 'layout',
                                    //     'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                                    //     'defaultValue' => 'layout1',
                                    //     'wrappers' => ['layout'],
                                    //     'templateOptions' => [
                                    //         'label' => 'Section Layout',
                                    //         'options' => $this->generateLayoutOptions(),
                                    //         'required' => true
                                    //     ],
                                    // ]),
                                    new FormlyFieldConfig([
                                        'key' => 'info_note',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                                        'templateOptions' => [
                                            'label' => 'Info note',
                                            'html' => true,
                                            'translatable' => true
                                        ]
                                    ]),
                                    new FormlyFieldConfig([
                                        'key' => 'product_options_group_photo',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                                        'templateOptions' => [
                                            'label' => 'Options Group Photo',
                                            'accept' => ['image/*'],
                                            'multiple' => true
                                        ]
                                    ]),
                                    new FormlyFieldConfig([
                                        'key' => 'displayMinOrderQty',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_CHECKBOX,
                                        'templateOptions' => [
                                            'label' => 'Display Min. Order Qty.'
                                        ]
                                    ]),
                                    new FormlyFieldConfig([
                                        'key' => 'product_options',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_HAS_MANY,
                                        'templateOptions' => [
                                            'label' => 'Product Options',
                                            'resource' => 'product',
                                            'displayColumnLabel' => 'Product option name',
                                            'displayColumn' => 'name',
                                            'searchBy' => ['name.' . config('app.locale'), 'sku'],
                                            'filter' => [
                                                'column' => 'type',
                                                'comparator' => '=',
                                                'value' => \App\Models\Product::PRODUCT_TYPE_OPTION
                                            ]
                                        ]
                                    ]),
                                ]
                            ])
                        ])
                    ]
                ])
            ]),
        ];
    }

    private function getProductModelFields($request)
    {
        return [
            new FormlyFieldConfig([
                'key' => 'additional_information',
                'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                'templateOptions' => [
                    'label' => 'Additional information',
                    'addText' => 'Add information',
                ],
                'fieldArray' => new FormlyFieldConfig([
                    'fieldGroup' => [
                        new FormlyFieldConfig([
                            'key' => 'info_type',
                            'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                            'defaultValue' => '',
                            'templateOptions' => [
                                'label' => 'Info type',
                                'required' => true,
                                'options' => [
                                    [
                                        'label' => 'Dimensions: W x D x H (cm)',
                                        'value' => 'Dimensions: W x D x H (cm)'
                                    ],
                                    [
                                        'label' => 'Wattage',
                                        'value' => 'Wattage'
                                    ],
                                    [
                                        'label' => 'IR Heaters',
                                        'value' => 'IR Heaters'
                                    ],
                                    [
                                        'label' => 'Oven/ Wattage',
                                        'value' => 'Oven/ Wattage'
                                    ],
                                    [
                                        'label' => 'Heating Equipment / Wattage',
                                        'value' => 'Heating Equipment / Wattage'
                                    ],
                                    [
                                        'label' => 'Steam Generator',
                                        'value' => 'Steam Generator'
                                    ]
                                ]
                            ],
                        ]),
                        new FormlyFieldConfig([
                            'key' => 'info_values',
                            'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                            'templateOptions' => [
                                'label' => 'Info values',
                                'addText' => 'Add value',
                            ],
                            'fieldArray' => new FormlyFieldConfig([
                                'fieldGroup' => [
                                    new FormlyFieldConfig([
                                        'key' => 'info_value',
                                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                        'templateOptions' => [
                                            'label' => 'Info value',
                                        ]
                                    ]),
                                ]
                            ])
                        ]),
                    ]
                ])
            ]),
            $this->getPackagingAndTransport('packagingTransport', 'Packaging & Transport'),
            $this->getPackagingAndTransport('packagingTransportAdditional', 'Additional Packaging & Transport')
        ];
    }

    private function getPackagingAndTransport($key, $label)
    {
        return new FormlyFieldConfig([
            'key' => $key,
            'wrappers' => ['panel'],
            'templateOptions' => [
                'label' => $label
            ],
            'fieldGroup' => [
                new FormlyFieldConfig([
                    'key' => 'parts',
                    'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                    'templateOptions' => [
                        'label' => 'Parts',
                        'addText' => 'Add part',
                    ],
                    'fieldArray' => new FormlyFieldConfig([
                        'fieldGroup' => [
                            new FormlyFieldConfig([
                                'key' => 'depth',
                                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                'templateOptions' => [
                                    'type' => 'number',
                                    'label' => 'Depth',
                                ]
                            ]),
                            new FormlyFieldConfig([
                                'key' => 'width',
                                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                'templateOptions' => [
                                    'label' => 'Width',
                                    'type' => 'number',
                                ]
                            ]),
                            new FormlyFieldConfig([
                                'key' => 'height',
                                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                'templateOptions' => [
                                    'label' => 'Height',
                                    'type' => 'number',
                                ]
                            ]),
                            new FormlyFieldConfig([
                                'key' => 'weight',
                                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                'templateOptions' => [
                                    'label' => 'Weight',
                                    'type' => 'number',
                                ]
                            ]),
                        ]
                    ])
                ]),
                new FormlyFieldConfig([
                    'key' => 'other_info',
                    'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                    'templateOptions' => [
                        'label' => 'Other info',
                        'translatable' => true
                    ]
                ]),
                new FormlyFieldConfig([
                    'key' => 'technical_design',
                    'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                    'templateOptions' => [
                        'label' => 'Technical Design',
                        'accept' => ['image/*']
                    ]
                ]),
            ]
        ]);
    }

    private function getProductOptionFields($request)
    {
        return [
            new FormlyFieldConfig([
                'key' => 'min_order_qty',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                'templateOptions' => [
                    'label' => 'Min. order qty',
                    'type' => 'number'
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'option_photo',
                'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                'templateOptions' => [
                    'label' => 'Option Photo',
                    'accept' => ['image/*']
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'details',
                'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Details',
                    'html' => true,
                    'translatable' => true,
                ]
            ]),
        ];
    }

    private function generateDisplayMatches($layouts)
    {
        $result = [];
        foreach ($layouts as $layout) {
            $result[] = [
                'id' => 'layout',
                'value' => 'layout' . $layout
            ];
        }
        return $result;
    }

    private function generateLayoutOptions()
    {
        return [
            [
                'label' => 'Options',
                'value' => 'layout14',
                'img' => asset('images/resize_layout14.png')
            ],
            [
                'label' => 'Options + Photos',
                'value' => 'layout1',
                'img' => asset('images/resize_layout1.png')
            ],
            [
                'label' => 'Only Photos',
                'value' => 'layout2',
                'img' => asset('images/resize_layout2.png')
            ],
            [
                'label' => 'Grouped Options in table',
                'value' => 'layout3',
                'img' => asset('images/resize_layout3.png')
            ],
            [
                'label' => 'Options grid view 2/1',
                'value' => 'layout5',
                'img' => asset('images/resize_layout5.png')
            ],
            [
                'label' => 'Grouped Options in table with photos on top',
                'value' => 'layout6',
                'img' => asset('images/resize_layout6.png')
            ],
            [
                'label' => 'Options grid view 3/1',
                'value' => 'layout7',
                'img' => asset('images/resize_layout7.png')
            ],
            [
                'label' => 'Options grid view 4/1',
                'value' => 'layout15',
                'img' => asset('images/resize_layout15.png')
            ],
            [
                'label' => 'Grouped Options in table with photos on left',
                'value' => 'layout8',
                'img' => asset('images/resize_layout8.png')
            ],
            [
                'label' => 'Options with details',
                'value' => 'layout11',
                'img' => asset('images/resize_layout11.png')
            ],
            [
                'label' => 'Grouped Options in table with photo group on top',
                'value' => 'layout12',
                'img' => asset('images/resize_layout12.png')
            ],
            [
                'label' => 'Options grid view 2/1 - type 2',
                'value' => 'layout13',
                'img' => asset('images/resize_layout13.png')
            ]
        ];
    }

    public function afterSave($request, $model)
    {
        if (data_get($model, 'type', '') === \App\Models\Product::PRODUCT_TYPE_MAIN) {
            $productOptionIds = [];
            $productModels = data_get($model, 'mainProductFields.product_models', []);
            foreach ($productModels as $productModel) {
                if ($productId = data_get($productModel, 'id', false)) {
                    $productOptionIds[] = $productId;
                }
            }
            $productSections = data_get($model, 'mainProductFields.product_sections', []);
            foreach ($productSections as $productSection) {
                $productOptionSections = data_get($productSection, 'product_option_sections', []);
                foreach ($productOptionSections as $productOptionSection) {
                    $productOptions = data_get($productOptionSection, 'product_options', []);
                    foreach ($productOptions as $productOption) {
                        if ($productOptionId = data_get($productOption, 'id', null)) {
                            $productOptionIds[] = $productOptionId;
                        }
                    }
                }
            }
            $model->mainProducts()->sync($productOptionIds);
        }
    }
}
