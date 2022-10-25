<div class="layout-8">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $photoGallery = getImagesFromPath($productOptionSection, 'product_options_group_photo', []);
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
            $displayPhotoInsteadTitle = data_get($productOptionSection, 'displayPhotoInsteadTitle', false);
            $productOptions = data_get($productOptionSection, 'product_options', []);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
        @endphp
        <table class="options-table w-100">
            <tr class="thead">
                @if(count($photoGallery) > 0)
                    <th rowspan="{{count($productOptions) + 1}}" class="images-column">
                        @foreach($photoGallery as $photo)
                            @include('render-image', ['photo' => $photo, 'class' => ['w-100', 'd-block']])
                        @endforeach
                    </th>
                @endif
                <th class="text-start">@t($productOptionSection, 'title', __('Options'))</th>
                @if ($displayMinOrderQty)
                    <th style="width: 16%">{{__('Min. order qty')}}</th>
                @endif
                <th style="width: 15%">{{__('Art. No.')}}</th>
                @if (!$hidePrices)
                <th style="width: 15%">{{__($pricelistTypeAcr ?? 'TP')}}</th>
                @endif
            </tr>
            @foreach($productOptions as $productOption)
                @php
                    $productOptionData = null;
                    $productOptionId = data_get($productOption, 'id', false);
                    if ($productOptionId) {
                        $productOptionData = \App\Models\Product::find($productOptionId);
                    }
                @endphp
                @if($productOptionData)
                    @php
                        $price = data_get($prices, getPriceKey($categoryId, $parentProduct, $productOptionData), ['value' => 0, 'onDemand' => false]);
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                        $productPhoto = getImagesFromPath($productOptionData, 'optionProductFields.option_photo', null);
                    @endphp
                    <tr>
                        <td class="text-start">
                            @switch($displayTitleType)
                                @case('photo')
                                        @if ($productPhoto)
                                            @include('render-image', ['photo' => $productPhoto, 'class' => ['w-100', 'd-block', 'mb-1']])
                                        @else
                                            @t($productOptionData, 'name', '')
                                        @endif
                                    @break
                                @case('description')
                                    @t($productOptionData, 'optionProductFields.details', '')
                                    @break
                                @case('title')
                                    @t($productOptionData, 'name', '')
                                    @break
                                @case('title_description')
                                    @t($productOptionData, 'name', '')<br/>
                                    @t($productOptionData, 'optionProductFields.details', '')
                                    @break
                                @default
                                    @t($productOptionData, 'name', '')
                            @endswitch
                        </td>
                        @if ($displayMinOrderQty)
                            <td>{{data_get($productOptionData, 'optionProductFields.min_order_qty', 1)}}</td>
                        @endif
                        <td>{{data_get($productOptionData, 'sku', '')}}</td>
                        @if (!$hidePrices)
                        <td class="price">
                            @if ($price['onDemand'])
                                {{__('on demand')}}
                            @else
                                @price(round($price['value'] * 100), $formatType)
                            @endif
                        </td>
                        @endif
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</div>
