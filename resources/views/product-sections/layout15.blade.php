<div class="layout-15">
    <div class="product-grid-4">
        @php
            $i = 0;
            $totalCount = 0;
        @endphp
        <table class="w-100">
            @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
                @php
                    $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
                    $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
                    $productOptions = data_get($productOptionSection, 'product_options', []);
                @endphp
                @foreach($productOptions as $productOption)
                    @php
                        $productOptionData = null;
                        $productOptionId = data_get($productOption, 'id', false);
                        if ($productOptionId) {
                            $productOptionData = \App\Models\Product::find($productOptionId);
                            if ($productOptionData) {
                                $i++;
                                $productOptionPhoto = getImagesFromPath($productOptionData, 'optionProductFields.option_photo');
                            }
                        }
                        $totalCount++;
                    @endphp
                    @if($productOptionData)
                        @php
                            $price = data_get($prices, getPriceKey($categoryId, $parentProduct, $productOptionData), ['value' => 0, 'onDemand' => false]);
                            $formatType = data_get($productOptionData, 'price_options.type', null);
                        @endphp
                        @if($i === 1)
                            <tr class="page-break-inside-avoid">
                                @endif
                                <td class="w-25 valign-top @if($i === 1) pe-2 @endif @if($i === 4) ps-2 @endif @if($i === 2 || $i == 3) ps-1 pe-1 @endif">
                                    <div class="product-item mb-1">
                                        @include('render-image', ['photo' => data_get($productOptionPhoto, '0'), 'class' => ['product-item-img']])
                                        <div class="product-item-title text-start">
                                            @t($productOptionData, 'name', '')
                                        </div>
                                        <table class="options-table">
                                            <thead>
                                            <tr>
                                                @if ($displayMinOrderQty)
                                                    <th style="width: 15%">{{__('Min. order qty')}}</th>
                                                @endif
                                                <th>{{__('Art. No.')}}</th>
                                                <th>{{__($pricelistTypeAcr ?? 'TP')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                @if ($displayMinOrderQty)
                                                    <td>{{data_get($productOptionData, 'optionProductFields.min_order_qty', 1)}}</td>
                                                @endif
                                                <td class="sku">{{data_get($productOptionData, 'sku', '')}}</td>
                                                <td class="price">
                                                    @if ($price['onDemand'])
                                                        {{__('on demand')}}
                                                    @else
                                                        @price($price['value'] * 100, $formatType)
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                                @if($i === 4 || $totalCount === count($productOptions))
                            </tr>
                        @endif
                        @php
                            if($i === 4) {
                                $i = 0;
                            }
                        @endphp
                    @endif
                @endforeach
            @endforeach
        </table>
    </div>
</div>
