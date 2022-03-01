<div class="layout-12 product-options-group-grid-2">
    @php
        $i = 0;
        $totalCount = 0;
        $productOptionSections = data_get($productSection, 'product_option_sections', []);
    @endphp
    <table class="w-100">
        @foreach ($productOptionSections as $productOptionSection)
            @php
                $i++;
                $totalCount++;
                $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
                $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
            @endphp
            @if ($i === 1)
                <tr class="page-break-inside-avoid">
            @endif
            <td class="w-50 valign-top @if ($i === 1) pe-2 @endif @if ($i === 2) ps-2 @endif">
                <div class="mb-1 w-100">
                    @php
                        $photoGallery = getImagesFromPath($productOptionSection, 'product_options_group_photo', []);
                    @endphp
                    <div class="photo-gallery">
                        @foreach ($photoGallery as $photo)
                            <div class="photo-gallery-item mb-2">
                                @include('render-image', ['photo' => $photo, 'class' => ['img']])
                            </div>
                        @endforeach
                    </div>
                    <table class="options-table w-100">
                        <thead>
                            <tr>
                                <th>@t($productOptionSection, 'title', __('Options'))</th>
                                @if ($displayMinOrderQty)
                                    <th style="width: 15%">{{__('Min. order qty')}}</th>
                                @endif
                                <th>{{__('Art. No.')}}</th>
                                <th>{{__($pricelistTypeAcr ?? 'TP')}}</th>
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
                                        $productPhoto = getImagesFromPath($productOptionData, 'optionProductFields.option_photo', null);
                                    @endphp
                                    <tr>
                                        <td>
                                            @switch($displayTitleType)
                                                @case('photo')
                                                    @if ($productPhoto)
                                                        @include('render-image', ['photo' => data_get($productPhoto, '0'), 'class' => [
                                                            'w-100',
                                                            'd-block',
                                                            'mb-1'
                                                        ]])
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
                                            <td>{{ data_get($productOptionData, 'optionProductFields.min_order_qty', 1) }}
                                            </td>
                                        @endif
                                        <td class="sku">{{ data_get($productOptionData, 'sku', '') }}</td>
                                        <td class="price">
                                            @if ($price['onDemand'])
                                                {{__('on demand')}}
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
            </td>
            @if ($i === 2 || $totalCount === count($productOptionSections))
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
