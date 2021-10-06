<div class="layout-12 product-options-group-grid-2">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        <div class="mb-1 product-options-group">
            @php
                $photoGallery = data_get($productOptionSection, 'product_options_group_photo', []);
                $photoGalleryUrls = [];
                foreach($photoGallery as $photo) {
                    $photoUrl = data_get($photo, 'url', false);
                    if ($photoUrl) {
                        $photoGalleryUrls[] = $photoUrl;
                    }
                }
            @endphp
            <div class="photo-gallery">
                @foreach($photoGalleryUrls as $url)
                    <div class="photo-gallery-item">
                        <div class="img" style="background-image: url('{{$url}}')"></div>
                    </div>
                @endforeach
            </div>
            <table class="options-table w-100">
                <thead>
                <tr>
                    <th class="text-start">@t($productOptionSection, 'title', 'Options')</th>
                    <th class="text-start">Art. No.</th>
                    <th class="text-end">TP</th>
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
                            <td class="text-start">@t($productOptionData, 'name', '')</td>
                            <td class="text-start">{{data_get($productOptionData, 'sku', '')}}</td>
                            <td class="price text-end">@price($price, $formatType)</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>
