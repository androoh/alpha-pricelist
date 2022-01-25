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
                        $productPhoto = null;
                        if ($productOptionId) {
                            $productOptionData = \App\Models\Product::find($productOptionId);
                            if ($productOptionData) {
                                $i++;
                                $productOptionPhotoUrl = data_get($productOptionData, 'optionProductFields.option_photo.0.name');
                            }
                        }
                        $totalCount++;
                    @endphp
                    @if($productOptionData)
                        @php
                            $price = data_get($prices, getPriceKey($categoryId, $parentProduct, $productOptionData), ['value' => 0, 'onDemand' => false]);
                            $formatType = data_get($productOptionData, 'price_options.type', null);
                            $productPhoto = data_get($productOptionData, 'optionProductFields.option_photo.0', null);
                            $photoUrl = $productPhoto ? data_get($productPhoto, 'name', null) : null;
                        @endphp
                        @if($i === 1)
                            <tr class="page-break-inside-avoid">
                                @endif
                                <td class="w-25 valign-top @if($i === 1) pe-2 @endif @if($i === 4) ps-2 @endif @if($i === 2 || $i == 3) ps-1 pe-1 @endif">
                                    <div class="product-item mb-1">
                                        <div class="product-item-img"
                                             @if($productOptionPhotoUrl)
                                             style="background-image: url('/imgc/a4mw/{{$productOptionPhotoUrl}}')"
                                            @endif
                                        ></div>
                                        <div class="product-item-title text-start">
                                            @t($productOptionData, 'name', '')
                                        </div>
                                        <table class="options-table">
                                            <thead>
                                            <tr>
                                                @if ($displayMinOrderQty)
                                                    <th style="width: 15%">Min. order qty</th>
                                                @endif
                                                <th>Art. No.</th>
                                                <th>TP</th>
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
                                                        on demand
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
