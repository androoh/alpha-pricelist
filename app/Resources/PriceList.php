<?php


namespace App\Resources;


use App\Formly\FormlyFieldConfig;
use Money\Currencies\ISOCurrencies;

class PriceList extends ResourceAbstract
{
    protected static $label = 'Price list';
    protected static $model = \App\Models\PriceList::class;
    protected static $searchBy = ['name'];
    protected static $icon = '<i class="bi bi-currency-dollar"></i>';
    protected $curencies = [];
    protected $currenciesMap = [
        'ALL' => 'Albania Lek',
        'AFN' => 'Afghanistan Afghani',
        'ARS' => 'Argentina Peso',
        'AWG' => 'Aruba Guilder',
        'AUD' => 'Australia Dollar',
        'AZN' => 'Azerbaijan New Manat',
        'BSD' => 'Bahamas Dollar',
        'BBD' => 'Barbados Dollar',
        'BDT' => 'Bangladeshi taka',
        'BYR' => 'Belarus Ruble',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermuda Dollar',
        'BOB' => 'Bolivia Boliviano',
        'BAM' => 'Bosnia and Herzegovina Convertible Marka',
        'BWP' => 'Botswana Pula',
        'BGN' => 'Bulgaria Lev',
        'BRL' => 'Brazil Real',
        'BND' => 'Brunei Darussalam Dollar',
        'KHR' => 'Cambodia Riel',
        'CAD' => 'Canada Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chile Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombia Peso',
        'CRC' => 'Costa Rica Colon',
        'HRK' => 'Croatia Kuna',
        'CUP' => 'Cuba Peso',
        'CZK' => 'Czech Republic Koruna',
        'DKK' => 'Denmark Krone',
        'DOP' => 'Dominican Republic Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egypt Pound',
        'SVC' => 'El Salvador Colon',
        'EEK' => 'Estonia Kroon',
        'EUR' => 'Euro Member Countries',
        'FKP' => 'Falkland Islands (Malvinas) Pound',
        'FJD' => 'Fiji Dollar',
        'GHC' => 'Ghana Cedis',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala Quetzal',
        'GGP' => 'Guernsey Pound',
        'GYD' => 'Guyana Dollar',
        'HNL' => 'Honduras Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'India Rupee',
        'IDR' => 'Indonesia Rupiah',
        'IRR' => 'Iran Rial',
        'IMP' => 'Isle of Man Pound',
        'ILS' => 'Israel Shekel',
        'JMD' => 'Jamaica Dollar',
        'JPY' => 'Japan Yen',
        'JEP' => 'Jersey Pound',
        'KZT' => 'Kazakhstan Tenge',
        'KPW' => 'Korea (North) Won',
        'KRW' => 'Korea (South) Won',
        'KGS' => 'Kyrgyzstan Som',
        'LAK' => 'Laos Kip',
        'LVL' => 'Latvia Lat',
        'LBP' => 'Lebanon Pound',
        'LRD' => 'Liberia Dollar',
        'LTL' => 'Lithuania Litas',
        'MKD' => 'Macedonia Denar',
        'MYR' => 'Malaysia Ringgit',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexico Peso',
        'MNT' => 'Mongolia Tughrik',
        'MZN' => 'Mozambique Metical',
        'NAD' => 'Namibia Dollar',
        'NPR' => 'Nepal Rupee',
        'ANG' => 'Netherlands Antilles Guilder',
        'NZD' => 'New Zealand Dollar',
        'NIO' => 'Nicaragua Cordoba',
        'NGN' => 'Nigeria Naira',
        'NOK' => 'Norway Krone',
        'OMR' => 'Oman Rial',
        'PKR' => 'Pakistan Rupee',
        'PAB' => 'Panama Balboa',
        'PYG' => 'Paraguay Guarani',
        'PEN' => 'Peru Nuevo Sol',
        'PHP' => 'Philippines Peso',
        'PLN' => 'Poland Zloty',
        'QAR' => 'Qatar Riyal',
        'RON' => 'Romania New Leu',
        'RUB' => 'Russia Ruble',
        'SHP' => 'Saint Helena Pound',
        'SAR' => 'Saudi Arabia Riyal',
        'RSD' => 'Serbia Dinar',
        'SCR' => 'Seychelles Rupee',
        'SGD' => 'Singapore Dollar',
        'SBD' => 'Solomon Islands Dollar',
        'SOS' => 'Somalia Shilling',
        'ZAR' => 'South Africa Rand',
        'LKR' => 'Sri Lanka Rupee',
        'SEK' => 'Sweden Krona',
        'CHF' => 'Switzerland Franc',
        'SRD' => 'Suriname Dollar',
        'SYP' => 'Syria Pound',
        'TWD' => 'Taiwan New Dollar',
        'THB' => 'Thailand Baht',
        'TTD' => 'Trinidad and Tobago Dollar',
        'TRY' => 'Turkey Lira',
        'TRL' => 'Turkey Lira',
        'TVD' => 'Tuvalu Dollar',
        'UAH' => 'Ukraine Hryvna',
        'GBP' => 'United Kingdom Pound',
        'USD' => 'United States Dollar',
        'UYU' => 'Uruguay Peso',
        'UZS' => 'Uzbekistan Som',
        'VEF' => 'Venezuela Bolivar',
        'VND' => 'Viet Nam Dong',
        'YER' => 'Yemen Rial',
        'ZWD' => 'Zimbabwe Dollar'
    ];

    protected function getCurrenciesOptions()
    {
        $isoCurrencies = new ISOCurrencies();
        $options = [];
        foreach ($isoCurrencies as $isoCurrency) {
            if (isset($this->currenciesMap[$isoCurrency->getCode()]) && $label = $this->currenciesMap[$isoCurrency->getCode()]) {
                $options[] = [
                    'label' => $label,
                    'value' => $isoCurrency->getCode()
                ];
            }
        }
        return $options;
    }

    public function config($request)
    {
        return [
            'clonable' => true
        ];
    }

    public function fields($request)
    {
        $languages = config('app.locales');
        $languageList = [];
        foreach ($languages as $key => $value) {
            $languageList[] = [
                'label' => $value,
                'value' => $key
            ];
        }
        return [
            new FormlyFieldConfig([
                'key' => 'name',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                'templateOptions' => [
                    'label' => 'Price list name',
                    'translatable' => true,
                    'filterable' => true,
                    'required' => true,
                    'sortable' => true,
                    'showInGrid' => true
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'layout',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'defaultValue' => 'layout1',
                'templateOptions' => [
                    'label' => 'Layout',
                    'required' => true,
                    'showInGrid' => true,
                    'options' => [
                        [
                            'label' => 'Layout 1',
                            'value' => 'layout1'
                        ],
                    ]
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'language',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'defaultValue' => 'en',
                'templateOptions' => [
                    'label' => 'Language',
                    'required' => true,
                    'showInGrid' => true,
                    'multiple' => true,
                    'options' => $languageList
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'type',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'defaultValue' => 'Trade',
                'templateOptions' => [
                    'label' => 'Type',
                    'required' => true,
                    'showInGrid' => true,
                    'options' => [
                        [
                            'label' => 'Trade',
                            'value' => 'Trade'
                        ],
                        [
                            'label' => 'Retail',
                            'value' => 'Retail'
                        ],
                    ]
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'year',
                'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                'defaultValue' => date('Y'),
                'templateOptions' => [
                    'label' => 'Year',
                    'required' => true,
                    'showInGrid' => true
                ],
            ]),
            new FormlyFieldConfig([
                'key' => 'currency',
                'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                'defaultValue' => 'EUR',
                'templateOptions' => [
                    'label' => 'Currency',
                    'required' => true,
                    'showInGrid' => true,
                    'options' => $this->getCurrenciesOptions()
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'firstPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'First page',
                    'preview' => 'first-page'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'photo',
                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                        'templateOptions' => [
                            'label' => 'First page photo',
                            'accept' => ['image/*']
                        ]
                    ]),
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'secondPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Second page',
                    'preview' => 'second-page'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'photo',
                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                        'templateOptions' => [
                            'label' => 'Second page photo',
                            'accept' => ['image/*']
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'title',
                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Title',
                            'translatable' => true,
                            'required' => true
                        ],
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'short_description',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Short Description',
                            'translatable' => true,
                            'required' => true,
                            'html' => true
                        ],
                    ]),
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'tocPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Table of contents',
                    'preview' => 'toc-page'
                ],
                'fieldGroup' => []
            ]),
            new FormlyFieldConfig([
                'key' => 'iconsPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Icons page',
                    'preview' => 'info-icons-page'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'photo_left_page',
                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                        'templateOptions' => [
                            'label' => 'Photo left page',
                            'accept' => ['image/*']
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'photo_right_page',
                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                        'templateOptions' => [
                            'label' => 'Photo right page',
                            'accept' => ['image/*']
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'title',
                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Title',
                            'translatable' => true,
                            'required' => true
                        ],
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'short_description',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Short Description',
                            'translatable' => true,
                            'required' => true,
                            'html' => true
                        ],
                    ]),
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'mainProductsPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Main products page'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'footer_text_1',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 1',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'footer_text_2',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 2',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'footer_text_3',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 3',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'categories',
                        'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                        'templateOptions' => [
                            'label' => 'Categories section',
                            'addText' => 'Add Category Section',
                            'preview' => 'category'
                        ],
                        'fieldArray' => new FormlyFieldConfig([
                            'fieldGroup' => [
                                new FormlyFieldConfig([
                                    'key' => 'category',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_SELECT,
                                    'templateOptions' => [
                                        'label' => 'Category',
                                        'placeholder' => '-- Please Select Category --',
                                        'options' => $this->getCategoryOptions(),
                                        'required' => true
                                    ],
                                ]),
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
                                    'key' => 'footer_text',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                                    'templateOptions' => [
                                        'label' => 'Footer text',
                                        'translatable' => true,
                                        'html' => true
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
                                new FormlyFieldConfig([
                                    'key' => 'main_products',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_HAS_MANY,
                                    'templateOptions' => [
                                        'label' => 'Products',
                                        'resource' => 'product',
                                        'displayColumnLabel' => 'Product name',
                                        'displayColumn' => 'name',
                                        'searchBy' => ['name.' . config('app.locale'), 'sku'],
                                        'filter' => [
                                            [
                                                'column' => 'type',
                                                'comparator' => '=',
                                                'value' => \App\Models\Product::PRODUCT_TYPE_MAIN
                                            ],
                                            [
                                                'column' => 'mainProductFields.category',
                                                'comparator' => '=',
                                                'valuePath' => 'category'
                                            ]
                                        ]
                                    ]
                                ]),
                                $this->getProductOptionSections()
                            ]
                        ])
                    ])
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'optionsAndAccessoriesPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Options and Accessories page',
                    'preview' => 'options-accessories-page'
                ],
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
                    new FormlyFieldConfig([
                        'key' => 'footer_text_1',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 1',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'footer_text_2',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 2',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'footer_text_3',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Footer text 3',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    $this->getProductOptionSections()
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'deliveryInstallationPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Delivery and Installation',
                    'preview' => 'delivery-installation'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'delivery_details',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Delivery details',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'priceType',
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
                'key' => 'additionalCostsPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Additional costs',
                    'preview' => 'additional-costs'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'title',
                        'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Title',
                            'translatable' => true,
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'info_note',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Info note',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'priceType',
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
                    new FormlyFieldConfig([
                        'key' => 'additional_costs_items',
                        'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
                        'templateOptions' => [
                            'label' => 'Additional costs items',
                            'addText' => 'Add Additional Cost',
                        ],
                        'fieldArray' => new FormlyFieldConfig([
                            'fieldGroup' => [
                                new FormlyFieldConfig([
                                    'key' => 'id',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_INPUT,
                                    'templateOptions' => [
                                        'label' => '',
                                        'type' => 'hidden'
                                    ],
                                ]),
                                new FormlyFieldConfig([
                                    'key' => 'name',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_INPUT_TRANSLATABLE,
                                    'templateOptions' => [
                                        'label' => 'Name',
                                        'translatable' => true,
                                        'required' => true
                                    ]
                                ])
                            ]
                        ])
                    ])
                ]
            ]),
            new FormlyFieldConfig([
                'key' => 'lastPage',
                'wrappers' => ['panel'],
                'templateOptions' => [
                    'label' => 'Last page',
                    'preview' => 'last-page'
                ],
                'fieldGroup' => [
                    new FormlyFieldConfig([
                        'key' => 'photo',
                        'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                        'templateOptions' => [
                            'label' => 'Last page photo',
                            'accept' => ['image/*']
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'details',
                        'type' => FormlyFieldConfig::FIELD_TYPE_TEXTAREA_TRANSLATABLE,
                        'templateOptions' => [
                            'label' => 'Details',
                            'translatable' => true,
                            'html' => true
                        ]
                    ]),
                ]
            ]),

        ];
    }

    private function getCategoryOptions()
    {
        return \App\Models\Category::all()->map(function ($category) {
            return [
                'label' => translateFromPath($category->name),
                'value' => $category->getKey()
            ];
        })->toArray();
    }

    private function getProductOptionSections()
    {
        return new FormlyFieldConfig([
            'key' => 'product_options_sections',
            'type' => FormlyFieldConfig::FIELD_TYPE_REPEAT,
            'templateOptions' => [
                'label' => 'Product Options Sections',
                'addText' => 'Add Product Options Section',
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
                        'key' => 'hideInToc',
                        'type' => FormlyFieldConfig::FIELD_TYPE_CHECKBOX,
                        'templateOptions' => [
                            'label' => 'Hide in table of contents'
                        ]
                    ]),
                    new FormlyFieldConfig([
                        'key' => 'pageBreakBefore',
                        'type' => FormlyFieldConfig::FIELD_TYPE_CHECKBOX,
                        'templateOptions' => [
                            'label' => 'Move section to a new page'
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
                            'multiple' => true,
                            'showConfig' => true
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
                                        'translatable' => true,
                                        'html' => true
                                    ]
                                ]),
                                new FormlyFieldConfig([
                                    'key' => 'product_options_group_photo',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_IMAGES,
                                    'templateOptions' => [
                                        'label' => 'Options Group Photo',
                                        'accept' => ['image/*'],
                                        'multiple' => true,
                                        'showConfig' => true
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
                                            ],
                                            [
                                                'label' => 'Display Title and Description',
                                                'value' => 'title_description'
                                            ]
                                        ]
                                    ],
                                ]),
                                new FormlyFieldConfig([
                                    'key' => 'photosSizeCover',
                                    'type' => FormlyFieldConfig::FIELD_TYPE_CHECKBOX,
                                    'templateOptions' => [
                                        'label' => 'Display photos as cover'
                                    ],
                                    'hideExpression' => "field.parent.parent.parent.model.layout !== 'layout7' && field.parent.parent.parent.model.layout !== 'layout13'"
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
        ]);
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
                'label' => 'Only Photos 1/1',
                'value' => 'layout4',
                'img' => asset('images/resize_layout2.png')
            ],
            [
                'label' => 'Only Photos 2/1',
                'value' => 'layout9',
                'img' => asset('images/resize_layout2.png')
            ],
            [
                'label' => 'Only Photos 3/1',
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
                'img' => asset('images/layout15.png')
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
}
