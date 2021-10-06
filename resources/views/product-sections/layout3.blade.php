<div class="layout-3">
    <table class="options-table w-100">
        <thead>
        <tr>
            <th class="text-start">Description</th>
            <th class="text-start">Art. No.</th>
            <th class="text-end">TP</th>
        </tr>
        </thead>
        <tbody>
        @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
            @php
                $productOptionSectionTitle = translateFromPath($productOptionSection, 'title', false);
            @endphp
            @if($productOptionSectionTitle)
                <tr class="group-row">
                    <td colspan="3">
                        {{$productOptionSectionTitle}}
                    </td>
                </tr>
            @endif
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
        @endforeach
        </tbody>
    </table>
</div>

