<div class="layout-5">
    <div class="product-grid-2">
        @foreach(data_get($productSection, 'product_option_sections', []) as $productOptionSection)
            @php
                $i = 0;
            @endphp
            <table class="w-100">
                <tbody>
                @foreach(data_get($productOptionSection, 'product_options', []) as $productOption)
                    @php
                        $productOptionData = null;
                        $productOptionId = data_get($productOption, 'id', false);
                        $productPhoto = null;
                        if ($productOptionId) {
                            $productOptionData = \App\Models\Product::find($productOptionId);
                            if ($productOptionData) {
                                $i++;
                                $productOptionPhotoUrl = data_get($productOptionData, 'optionProductFields.option_photo.0.name');
                            }
                        }
                    @endphp
                    @if($productOptionData)
                        @php
                            $price = data_get($prices, $productOptionId, 0);
                            $formatType = data_get($productOptionData, 'price_options.type', null);
                        @endphp
                        @if($i === 1)
                            <tr class="page-break-inside-avoid">
                                @endif
                                <td class="@if($i === 1) pe-2 @endif @if($i === 2) ps-2 @endif">
                                    <div class="product-item mb-1">
                                        <div class="product-item-img"
                                             @if($productOptionPhotoUrl)
                                             style="background-image: url('/imgc/a4mw/{{$productOptionPhotoUrl}}')"
                                            @endif
                                        >
                                            <div class="product-item-title text-truncate">
                                                @t($productOptionData, 'name', '')
                                            </div>
                                        </div>
                                        <div class="product-item-footer text-end float-end">
                                            {{data_get($productOptionData, 'sku', '')}}
                                            <span class="price">@price($price, $formatType)</span>
                                        </div>
                                    </div>
                                </td>
                                @if($i === 2)
                            </tr>
                        @endif
                        @php
                            if($i === 2) {
                                $i = 0;
                            }
                        @endphp
                    @endif
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</div>
