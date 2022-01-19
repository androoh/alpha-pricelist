<div class="layout-8">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $photoGallery = data_get($productOptionSection, 'product_options_group_photo', []);
            $photoGalleryUrls = [];
            foreach($photoGallery as $photo) {
                $photoUrl = data_get($photo, 'name', false);
                if ($photoUrl) {
                    $photoGalleryUrls[] = $photoUrl;
                }
            }
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
            $displayPhotoInsteadTitle = data_get($productOptionSection, 'displayPhotoInsteadTitle', false);
            $productOptions = data_get($productOptionSection, 'product_options', []);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
        @endphp
        <table class="options-table w-100">
            <tr class="thead">
                @if(count($photoGalleryUrls) > 0)
                    <th rowspan="{{count($productOptions) + 1}}" class="images-column">
                        @foreach($photoGalleryUrls as $url)
                            <img src="/imgc/a4mw/{{$url}}" class="w-100 d-block"/>
                        @endforeach
                    </th>
                @endif
                <th class="text-start">@t($productOptionSection, 'title', 'Options')</th>
                @if ($displayMinOrderQty)
                    <th style="width: 15%">Min. order qty</th>
                @endif
                <th style="width: 15%">Art. No.</th>
                <th style="width: 15%">TP</th>
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
                        $productPhoto = data_get($productOptionData, 'optionProductFields.option_photo.0', null);
                        $photoUrl = $productPhoto ? data_get($productPhoto, 'url', null) : null;
                    @endphp
                    <tr>
                        <td class="text-start">
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
                        <td>{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">
                            @if ($price['onDemand'])
                                on demand
                            @else
                                @price($price['value'] * 100, $formatType)
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</div>
