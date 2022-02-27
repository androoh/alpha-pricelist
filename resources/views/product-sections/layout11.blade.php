<div class="layout-11">
    @foreach (data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        @php
            $displayMinOrderQty = data_get($productOptionSection, 'displayMinOrderQty', false);
            $displayTitleType = data_get($productOptionSection, 'titleDisplayType', 'title');
            $productOptions = data_get($productOptionSection, 'product_options', []);
        @endphp
        <table class="options-table w-100">
            <thead class="page-break-after-avoid">
                <tr>
                    <th>@t($productOptionSection, 'title', __('Options'))</th>
                    @if ($displayMinOrderQty)
                        <th style="width: 15%">{{__('Min. order qty')}}</th>
                    @endif
                    <th>{{__('Art. No.')}}</th>
                    <th>{{__('TP')}}</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp
            <tbody>
                @foreach ($productOptions as $productOption)
                    @php
                        $i++;
                        $productOptionData = null;
                        $productOptionId = data_get($productOption, 'id', false);
                        if ($productOptionId) {
                            $productOptionData = \App\Models\Product::find($productOptionId);
                        }
                        $class = $i % 2 === 0 ? 'even' : 'odd';
                    @endphp
                    @if ($productOptionData)
                        @php
                            $price = data_get($prices, getPriceKey($categoryId, $parentProduct, $productOptionData), ['value' => 0, 'onDemand' => false]);
                            $formatType = data_get($productOptionData, 'price_options.type', null);
                        @endphp
                        <tr class="page-break-inside-avoid page-break-after-avoid">
                            <td colspan="3" class="title-row fw-bold">
                                @t($productOptionData, 'name', '')
                            </td>
                        </tr>
                        <tr class="{{ $class }} page-break-inside-avoid">
                            <td>@t($productOptionData, 'optionProductFields.details', '')</td>
                            @if ($displayMinOrderQty)
                                <td>{{ data_get($productOptionData, 'optionProductFields.min_order_qty', 1) }}</td>
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
    @endforeach
</div>
