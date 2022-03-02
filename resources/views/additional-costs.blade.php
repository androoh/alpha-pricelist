@php
$additionalCostsPage = data_get($resourceData, 'additionalCostsPage', []);
$prices = data_get($resourceData, 'prices', []);
$formatType = data_get($additionalCostsPage, 'priceType', null);
$title = translateFromPath($additionalCostsPage, 'title', '');
$infoNote = translateFromPath($additionalCostsPage, 'info_note', null);
@endphp
<div class="additional-costs mt-4">
    <table class="options-table w-100 mb-2 repeating-container">
        <thead class="repeating-header">
            <tr style="border-bottom: 2pt #4D545E solid;">
                <th colspan="2">{{ $title }}</th>
            </tr>
        </thead>
        <tbody class="repeating-container-body">
            @foreach (data_get($additionalCostsPage, 'additional_costs_items', []) as $treeItem)
                @php
                    $priceKey = data_get($treeItem, 'id', '');
                    $price = data_get($prices, $priceKey, ['value' => 0, 'onDemand' => false]);
                @endphp
                <tr>
                    <td>
                        @t($treeItem, 'name', '')
                    </td>
                    <td class="price">
                        @if ($price['onDemand'])
                            {{__('on demand')}}
                        @else
                            @price($price['value'] * 100, $formatType)
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @if ($infoNote)
        <div class="info-note">
            {{__('Info Note')}} <br/>
            {!!$infoNote!!}
        </div>
    @endif
</div>
