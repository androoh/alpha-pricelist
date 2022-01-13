<div class="layout-6">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        <div class="mb-1">
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
            <div class="photo-gallery-2 w-100">
                <table class="w-100">
                    @php
                        $i = 0;
                    @endphp
                    @foreach($photoGalleryUrls as $url)
                        @php
                            $i++;
                            $class = '';
                            if ($i === 1 && count($photoGalleryUrls) > 1) {
                                $class = 'pe-1';
                            }
                            if ($i === 2) {
                                $class = 'ps-1';
                            }
                        @endphp
                        @if($i === 1)
                            <tr class="page-break-inside-avoid">
                                @endif
                                <td style="width: {{(100/count($photoGalleryUrls))}}%" class="{{$class}}">
                                    <div class="photo-gallery-item" style="background-image: url('/imgc/a4mw/{{$url}}');"></div>
                                </td>
                                @if($i === 3)
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
            <table class="options-table w-100">
                <thead>
                <tr>
                    <th class="text-start">@t($productOptionSection, 'title', 'Options')</th>
                    <th class="text-center">Art. No.</th>
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
        </div>
    @endforeach
</div>
