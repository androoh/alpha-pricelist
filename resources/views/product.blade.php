<div class="product-page" id="product-{{$product->getKey()}}">
    <div class="left-header">
        <div class="d-flex justify-content-start">
            <div class="price-list-type">@t($priceList, 'firstPage.type', 'Trade')</div>
            <div class="product-complexity ms-4">@t($product, 'mainProductFields.complexity', 'Basic')</div>
            <div class="category-name ms-3">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="right-header">
        <div class="d-flex justify-content-end">
            <div class="product-complexity me-4">@t($product, 'mainProductFields.complexity', 'Basic')</div>
            <div class="category-name">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="right-badge">
        <div class="badge">
            <div class="category-name">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="product-page-footer">@t($priceList, 'mainProductsPage.footer_text', '-')</div>
    <div class="page-counter"></div>
    <div class="page-body">
        <table class="product-info mb-3">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    @php
                        $mainPhotoUrl = data_get($product, 'mainProductFields.main_photo.0.name', false);
                        $mainPhotoInfoNote = translateFromPath($product, 'mainProductFields.main_photo_info_note', false);
                    @endphp
                    @if($mainPhotoUrl)
                        <div class="main-photo w-100 p-4">
                            <img src="/imgc/a4lw/{{$mainPhotoUrl}}" class="d-block w-100"/>
                            @if($mainPhotoInfoNote)
                                <div class="info-note">{{$mainPhotoInfoNote}}</div>
                            @endif
                        </div>
                    @endif
                </td>
                <td style="vertical-align: top;">
                    <h1 class="product-title">@t($product, 'name', '')</h1>
                    <div class="standard-equipment">
                        <h3 class="title">Standard Equipment</h3>
                        <div class="description mb-3">
                            @t($product, 'mainProductFields.standard_equipment', '')
                        </div>
                    </div>
                    @php
                        $infoIcons = data_get($product, 'mainProductFields.info_icons', []);
                        $infoIconsUrl = [];
                        foreach($infoIcons as $infoIconId) {
                        $infoIconData = \App\Models\InfoIcon::find($infoIconId);
                        if ($infoIcons) {
                            $infoIconUrl = data_get($infoIconData, 'iconPhoto.0.name', false);
                            if ($infoIconUrl) {
                                $infoIconsUrl[] = $infoIconUrl;
                            }
                        }
                        }
                    @endphp
                    <div class="info-icons">
                        @foreach ($infoIconsUrl as $infoIconUrl)
                            <img src="/imgc/a4lw/{{$infoIconUrl}}" style="height: 40pt"/>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        @include('product-models', ['product' => $product, 'prices' => data_get($priceList, 'prices', [])])
        @include('product-sections', ['productSections' => data_get($product, 'mainProductFields.product_sections', []), 'prices' => data_get($priceList, 'prices', [])])
        @include('product-models-packaging-transport', ['product' => $product])
    </div>
</div>
