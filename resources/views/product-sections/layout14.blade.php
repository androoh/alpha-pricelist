<div class="layout-1">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $displayPhotoInsteadTitle = data_get($productOptionSection, 'displayPhotoInsteadTitle', false);
        @endphp
        <table class="options-table w-100 mb-4">
            <thead>
            <tr>
                <th>@t($productOptionSection, 'title', 'Options')</th>
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
                        $price = data_get($prices, $productOptionId, 0);
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                        $productPhoto = data_get($productOptionData, 'optionProductFields.option_photo.0', null);
                        $photoUrl = $productPhoto ? data_get($productPhoto, 'name', null) : null;
                    @endphp
                    <tr>
                        <td>
                            @if ($displayPhotoInsteadTitle && $photoUrl)
                                <img src="/imgc/a4lw/{{$photoUrl}}" class="w-100 d-block mb-1"/>
                            @else
                                @t($productOptionData, 'name', '')
                            @endif
                        </td>
                        <td>{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">@price($price, $formatType)</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
