<div class="layout-6">
    @foreach (data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        <div class="mb-1 page-break-inside-avoid">
            @php
                $photoGallery = data_get($productOptionSection, 'product_options_group_photo', []);
                $photoGalleryUrls = [];
                $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
                foreach ($photoGallery as $photo) {
                    $photoUrl = data_get($photo, 'name', false);
                    if ($photoUrl) {
                        $photoGalleryUrls[] = $photoUrl;
                    }
                }
                $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
            @endphp
            <div class="photo-gallery-2 w-100">
                <table class="w-100">
                    @php
                        $i = 0;
                        $totalCount = 0;
                    @endphp
                    @foreach ($photoGalleryUrls as $url)
                        @php
                            $i++;
                            $class = '';
                            if ($i === 1 && count($photoGalleryUrls) > 1) {
                                $class = 'pe-1';
                            }
                            if ($i === 2) {
                                $class = 'ps-1';
                            }
                            $totalCount++;
                        @endphp
                        @if ($i === 1)
                            <tr class="page-break-inside-avoid">
                        @endif
                        <td style="width: {{ 100 / count($photoGalleryUrls) }}%" class="{{ $class }}">
                            <div class="photo-gallery-item mb-2"
                                style="background-image: url('/imgc/a4mw/{{ $url }}');"></div>
                        </td>
                        @if ($i === 2 || $totalCount === count($photoGalleryUrls))
                            </tr>
                        @endif
                        @php
                            if ($i === 2) {
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
                        @if ($displayMinOrderQty)
                            <th style="width: 15%">Min. order qty</th>
                        @endif
                        <th class="text-center">Art. No.</th>
                        <th class="text-end">TP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (data_get($productOptionSection, 'product_options', []) as $productOption)
                        @php
                            $productOptionData = null;
                            $productOptionId = data_get($productOption, 'id', false);
                            if ($productOptionId) {
                                $productOptionData = \App\Models\Product::find($productOptionId);
                            }
                        @endphp
                        @if ($productOptionData)
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
                                                <img src="/imgc/a4mw/{{ $photoUrl }}" class="w-100 d-block mb-1" />
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
                                        @case('title_description')
                                            @t($productOptionData, 'name', '')<br />
                                            @t($productOptionData, 'optionProductFields.details', '')
                                        @break
                                        @default
                                            @t($productOptionData, 'name', '')
                                    @endswitch
                                </td>
                                @if ($displayMinOrderQty)
                                    <td>{{ data_get($productOptionData, 'optionProductFields.min_order_qty', 1) }}</td>
                                @endif
                                <td class="sku">{{ data_get($productOptionData, 'sku', '') }}</td>
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
        </div>
    @endforeach
</div>
