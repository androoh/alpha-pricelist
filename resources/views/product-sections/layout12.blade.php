<div class="layout-12 product-options-group-grid-2">
    @php
        $i = 0;
    @endphp
    <table class="w-100">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $i++;
        @endphp
        @if($i === 1)
            <tr class="page-break-inside-avoid">
        @endif
        <td class="w-50 valign-top @if($i === 1) pe-2 @endif @if($i === 2) ps-2 @endif">
        <div class="mb-1 w-100">
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
            <div class="photo-gallery">
                @foreach($photoGalleryUrls as $url)
                    <div class="photo-gallery-item">
                        <div class="img" style="background-image: url('/imgc/a4lw/{{$url}}')"></div>
                    </div>
                @endforeach
            </div>
            <table class="options-table w-100">
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
        </div>
        </td>
        @if($i === 2)
                            </tr>
                        @endif
                        @php
                            if($i === 2) {
                                $i = 0;
                            }
                        @endphp
    @endforeach
    </table>
</div>
