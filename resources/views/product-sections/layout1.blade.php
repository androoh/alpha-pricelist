<div class="layout-1">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
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
                        $price = data_get($prices, getPriceKey($productOptionData, $parentProduct), 0);
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                    @endphp
                    <tr>
                        <td>@t($productOptionData, 'name', '')</td>
                        <td class="sku">{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">@price($price, $formatType)</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        @php
            $photoGallery = data_get($productOptionSection, 'product_options_group_photo', []);
            $photoGalleryUrls = [];
            foreach($photoGallery as $photo) {
                $photoUrl = data_get($photo, 'name', false);
                if ($photoUrl) {
                    $photoGalleryUrls[] = $photoUrl;
                }
            }
        @endphp
        <div class="photo-gallery-3">
            <table>
                @php
                    $i = 0;
                @endphp
                @foreach($photoGalleryUrls as $url)
                    @php
                        $i++;
                    @endphp
                    @if($i === 1)
                        <tr class="page-break-inside-avoid">
                    @endif
                    <td class="@if($i === 1) pe-2 @endif @if($i === 3) ps-2 @endif @if($i === 2) ps-1 pe-1 @endif">
                        <div class="photo-gallery-item">
                            <img src="/imgc/a4mw/{{$url}}"/>
                        </div>
                    </td>
                    @if($i === 3)
                        </tr>
                    @endif
                    @php
                        if($i === 3) {
                            $i = 0;
                        }
                    @endphp
                @endforeach
            </table>
        </div>
    @endforeach
</div>
