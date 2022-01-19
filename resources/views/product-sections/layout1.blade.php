<div class="layout-1">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
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
                        $price = data_get($prices, getPriceKey($categoryId, $parentProduct, $productOptionData), ['value' => 0, 'onDemand' => false]);
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
