<div class="layout-11">
    @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
        <table class="options-table w-100">
            <thead class="page-break-after-avoid">
                <tr>
                    <th>@t($productOptionSection, 'title', 'Options')</th>
                    <th>Art. No.</th>
                    <th>TP</th>
                </tr>
            </thead>
            @php
                $i = 0;
            @endphp
            <tbody>
            @foreach(data_get($productOptionSection, 'product_options', []) as $productOption)
                @php
                    $i++;
                    $productOptionData = null;
                    $productOptionId = data_get($productOption, 'id', false);
                    if ($productOptionId) {
                        $productOptionData = \App\Models\Product::find($productOptionId);
                    }
                    $class = $i % 2 === 0 ? 'even' : 'odd';
                @endphp
                @if($productOptionData)
                    @php
                        $price = data_get($prices, $productOptionId, 0);
                        $formatType = data_get($productOptionData, 'price_options.type', null);
                    @endphp
                    <tr class="page-break-inside-avoid page-break-after-avoid">
                        <td colspan="3" class="title-row">@t($productOptionData, 'name', '')</td>
                    </tr>
                    <tr class="{{$class}} page-break-inside-avoid">
                        <td>@t($productOptionData, 'optionProductFields.details', '')</td>
                        <td  class="sku">{{data_get($productOptionData, 'sku', '')}}</td>
                        <td class="price">@price($price, $formatType)</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endforeach
</div>
