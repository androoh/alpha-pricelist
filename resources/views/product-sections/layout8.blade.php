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
        @endphp
        <table class="options-table w-100">
            <tr class="thead">
                @if(count($photoGalleryUrls) > 0)
                    <th rowspan="{{count($productOptions) + 1}}" class="images-column" style="width: 10%">
                        @foreach($photoGalleryUrls as $url)
                            <img src="/imgc/a4lw/{{$url}}" class="w-100 d-block"/>
                        @endforeach
                    </th>
                @endif
                <th>@t($productOptionSection, 'title', 'Options')</th>
                @if ($displayMinOrderQty)
                    <th style="width: 15%">min. order qty</th>
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
                        $price = data_get($prices, $productOptionId, 0);
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                        $productPhoto = data_get($productOptionData, 'optionProductFields.option_photo.0', null);
                        $photoUrl = $productPhoto ? data_get($productPhoto, 'url', null) : null;
                    @endphp
                    <tr>
                        <td>
                            @if ($displayPhotoInsteadTitle && $photoUrl)
                                <img src="{{$photoUrl}}" class="w-100 d-block mb-1"/>
                            @else
                                @t($productOptionData, 'name', '')
                            @endif
                        </td>
                        @if ($displayMinOrderQty)
                            <td>{{data_get($productOptionData, 'min_order_qty', 1)}}</td>
                        @endif
                        <td>{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">@price($price, $formatType)</td>
                    </tr>
                @endif
            @endforeach
        </table>
    @endforeach
</div>
