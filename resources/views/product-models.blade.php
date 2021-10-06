@php
    $columns = [];
    $rows = [];
    foreach (data_get($product, 'mainProductFields.product_models', []) as $productModel) {
        $productModelData = null;
        $productOptionId = data_get($productModel, 'id', false);
        if ($productOptionId) {
            $productModelData = \App\Models\Product::find($productOptionId);
            $additionalInformation = data_get($productModelData, 'modelProductFields.additional_information', []);
            $row = [];
            if (!in_array('Model', $columns)) {
                $columns[] = 'Model';
            }
            $row['data'] = $productModelData;
            $row['Model'] = [['info_value' => translateFromPath($productModelData, 'name', '')]];
            foreach ($additionalInformation as $info) {
                $infoType = data_get($info, 'info_type', false);
                $infoValues = data_get($info, 'info_values', []);
                if ($infoType) {
                    if (!in_array($infoType, $columns)) {
                        $columns[] = $infoType;
                    }
                    $row[$infoType] = $infoValues;
                }
            }
            $rows[] = $row;
        }
    }
@endphp
@if (count($columns) > 0)
    <table class="options-table w-100 mb-4">
        <thead>
        <tr>
            @foreach($columns as $column)
                <th class="text-start">{{$column}}</th>
            @endforeach
            <th class="text-start">Art. No.</th>
            <th class="text-end">TP</th>
        </tr>
        </thead>
        <tbody>
        @foreach($rows as $row)
            @php
            $price = data_get($prices, data_get($row, 'data._id', null), 0);
            $formatType = data_get($row, 'price_options.type', '');
            @endphp
            <tr>
                @foreach($columns as $column)
                    <td>
                        @if(isset($row[$column]) && $row[$column])
                            @foreach($row[$column] as $value)
                                <div>{{data_get($value, 'info_value', '-')}}</div>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                @endforeach
                <td class="text-start">{{data_get($row, 'data.sku', '')}}</td>
                <td class="price text-end">@price($price, $formatType)</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
