<div class="layout-1">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $displayPhotoInsteadTitle = data_get($productOptionSection, 'displayPhotoInsteadTitle', false);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
        @endphp
        <table class="options-table w-100 mb-4">
            <thead>
            <tr>
                <th>@t($productOptionSection, 'title', 'Options')</th>
                @if ($displayMinOrderQty)
                    <th style="width: 15%">Min. order qty</th>
                @endif
                <th>Art. No.</th>
                <th>TP</th>
            </tr>
            </thead>
            <tbody>
            @foreach(data_get($productOptionSection, 'product_options', []) as $productOption)
                @php
                    $productOptionData = null;
                    $productOptionId = data_get($productOption, 'id', false);
                    if ($productOptionId) {
                        $productOptionData = \App\Models\Product::find($productOptionId);
                    }
                @endphp
                @if($productOptionData)
                    @php
                        $price = data_get($prices, getPriceKey($productOptionData, $parentProduct), 0) * 100;
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                        $productPhoto = data_get($productOptionData, 'optionProductFields.option_photo.0', null);
                        $photoUrl = $productPhoto ? data_get($productPhoto, 'name', null) : null;
                    @endphp
                    <tr>
                        <td>
                            @switch($displayTitleType)
                                @case('photo')
                                        @if ($photoUrl)
                                            <img src="/imgc/a4mw/{{$photoUrl}}" class="w-100 d-block mb-1"/>
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
                                @default
                                    @t($productOptionData, 'name', '')
                            @endswitch
                        </td>
                        @if ($displayMinOrderQty)
                            <td>{{data_get($productOptionData, 'optionProductFields.min_order_qty', 1)}}</td>
                        @endif
                        <td class="sku">{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">@price($price, $formatType)</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
