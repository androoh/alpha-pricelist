<div class="layout-1">
    @foreach (data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
        @endphp
        <table class="options-table w-100 mb-2">
            <thead>
                <tr>
                    <th>@t($productOptionSection, 'title', __('Options'))</th>
                    @if ($displayMinOrderQty)
                        <th style="width: 15%">{{ __('Min. order qty') }}</th>
                    @endif
                    <th>{{ __('Art. No.') }}</th>
                    @if (!$hidePrices)
                    <th>{{ __($pricelistTypeAcr ?? 'TP') }}</th>
                    @endif
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
                                            @include('render-image', ['photo' => $productPhoto, 'class' => [
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
                                <td>{{ data_get($productOptionData, 'optionProductFields.min_order_qty', 1) }}</td>
                            @endif
                            <td class="sku">{{ data_get($productOptionData, 'sku', '') }}</td>
                            @if (!$hidePrices)
                            <td class="price">
                                @if ($price['onDemand'])
                                    {{ __('on demand') }}
                                @else
                                    @price(round($price['value'] * 100), $formatType)
                                @endif
                            </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @php
            $photoGallery = getImagesFromPath($productOptionSection, 'product_options_group_photo', []) ?? [];
        @endphp
        <div class="photo-gallery-3">
            <table>
                @php
                    $i = 0;
                @endphp
                @foreach ($photoGallery as $photo)
                    @php
                        $i++;
                    @endphp
                    @if ($i === 1)
                        <tr class="page-break-inside-avoid">
                    @endif
                    <td class="@if ($i === 1) pe-2 @endif @if ($i === 3) ps-2 @endif @if ($i === 2) ps-1 pe-1 @endif">
                        <div class="photo-gallery-item mb-2">
                            @include('render-image', ['photo' => $photo])
                        </div>
                    </td>
                    @if ($i === 3)
                        </tr>
                    @endif
                    @php
                        if ($i === 3) {
                            $i = 0;
                        }
                    @endphp
                @endforeach
            </table>
        </div>
    @endforeach
</div>
