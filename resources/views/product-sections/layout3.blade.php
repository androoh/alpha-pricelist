<div class="layout-3">
    <table class="options-table w-100">
        <thead>
            <tr>
                <th>Description</th>
                <th>Art. No.</th>
                <th>TP</th>
            </tr>
        </thead>
        <tbody>
            @foreach (data_get($productSection, 'product_option_sections', []) as $productOptionSection)
                @php
                    $productOptionSectionTitle = translateFromPath($productOptionSection, 'title', false);
                    $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
                @endphp
                @if ($productOptionSectionTitle)
                    <tr class="group-row">
                        <td colspan="3">
                            {{ $productOptionSectionTitle }}
                        </td>
                    </tr>
                @endif
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
            @endforeach
        </tbody>
    </table>
</div>
