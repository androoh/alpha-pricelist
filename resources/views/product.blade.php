<div class="product-page" id="product-{{ $product->getKey() }}">
    <div class="left-header">
        <div class="d-flex justify-content-start">
            <div class="price-list-type">{{ __(data_get($resourceData, 'type', 'Trade')) }}</div>
            <div class="product-complexity ms-4">{{ __(data_get($product, 'mainProductFields.complexity', 'Basic')) }}
            </div>
            <div class="category-name ms-3">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="right-header">
        <div class="d-flex justify-content-end">
            <div class="product-complexity me-4">{{  __(data_get($product, 'mainProductFields.complexity','Basic')) }}
            </div>
            <div class="category-name">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="right-badge">
        <div class="badge">
            <div class="category-name">@t($category, 'name', '-')</div>
        </div>
    </div>
    <div class="product-page-footer-left product-page-footer">
        <div class="page-counter"></div>
        <div class="footer-text-1">@t($resourceData, 'mainProductsPage.footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($resourceData, 'mainProductsPage.footer_text_2', '')</div>
            <div>@t($product, 'mainProductFields.footer_notes', '')</div>
            <div>@t($treeItem, 'footer_text', '')</div>
        </div>
        <div class="footer-text-3">@t($resourceData, 'mainProductsPage.footer_text_3', '')</div>
    </div>
    <div class="product-page-footer-right product-page-footer">
        <div class="footer-text-1">@t($resourceData, 'mainProductsPage.footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($resourceData, 'mainProductsPage.footer_text_2', '')</div>
            <div>@t($product, 'mainProductFields.footer_notes', '')</div>
            <div>@t($treeItem, 'footer_text', '')</div>
        </div>
        <div class="footer-text-3">@t($resourceData, 'mainProductsPage.footer_text_3', '')</div>
        <div class="page-counter"></div>
    </div>
    <div class="page-body">
        <table class="product-info mb-2">
            <tr>
                <td style="width: 40%; vertical-align: top;">
                    @php
                        $mainPhoto = getImagesFromPath($product, 'mainProductFields.main_photo', false);
                        $mainPhotoInfoNote = translateFromPath($product, 'mainProductFields.main_photo_info_note', false);
                        $infoNote = translateFromPath($product, 'mainProductFields.info_note', false);
                        $clientSuply = translateFromPath($product, 'mainProductFields.client_suply', false);
                        $awardsPhotos = getImagesFromPath($product, 'mainProductFields.awards_photos', []) ?? [];
                    @endphp
                    @if ($mainPhoto)
                        <div class="main-photo w-100 p-4">
                            @include('render-image', ['photo' => data_get($mainPhoto, '0'), 'class' => ['w-100',
                            'd-block']])
                            @if ($mainPhotoInfoNote)
                                <div class="info-note">{{ $mainPhotoInfoNote }}</div>
                            @endif
                        </div>
                    @endif
                </td>
                <td style="vertical-align: top;">
                    <h1 class="product-title">@t($product, 'name', '')</h1>
                    <div class="standard-equipment">
                        <h3 class="title">{{ __('Standard Equipment') }}</h3>
                        <div class="description mb-2">
                            @t($product, 'mainProductFields.standard_equipment', '')
                        </div>
                        @if ($clientSuply)
                            <div class="client-suply mb-2 description">
                                <strong>{{ __('The client to supply:') }}</strong>
                                {!! $clientSuply !!}
                            </div>
                        @endif
                        @if ($infoNote)
                            <div class="info-note mb-2 fst-italic fw-bolder">
                                <div>{{ __('Info Note') }}</div>
                                {!! $infoNote !!}
                            </div>
                        @endif
                    </div>

                    @php
                        $infoIcons = data_get($product, 'mainProductFields.info_icons', []);
                        $infoIconsArr = [];
                        foreach ($infoIcons as $infoIconId) {
                            $infoIconData = \App\Models\InfoIcon::find($infoIconId);
                            if ($infoIcons) {
                                $infoIcon = getImagesFromPath($infoIconData, 'iconPhoto', false);
                                if ($infoIcon) {
                                    $infoIconsArr[] = $infoIcon;
                                }
                            }
                        }
                    @endphp
                    <div class="info-icons">
                        @foreach ($infoIconsArr as $infoIconPhoto)
                            @include('render-image', ['photo' => data_get($infoIconPhoto, '0'), 'style' => 'height:
                            35pt'])
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        @php
            $pricelistType = data_get($resourceData, 'type', 'Trade');
            $pricelistTypeAcr = ($pricelistType === 'Trade') ? 'TP' : 'RP';
         @endphp
        @include('product-models', [
            'categoryId' => $categoryId,
            'product' => $product,
            'prices' => data_get($resourceData, 'prices', []),
            'pricelistTypeAcr' => $pricelistTypeAcr
        ])
        @include('product-sections', [
            'categoryId' => $categoryId,
            'parentProduct' => $product,
            'pricelistTypeAcr' => $pricelistTypeAcr,
            'productSections' => data_get($product, 'mainProductFields.product_sections', []),
            'prices' => data_get($resourceData, 'prices', [])
        ])
        @include('product-models-packaging-transport', ['product' => $product])
        @if (count($awardsPhotos) > 0)
            <div class="awards-photots-section page-break-inside-avoid">
                <h3>{{ __('Winner') }}</h3>
                <div class="awards-photots">
                    @foreach ($awardsPhotos as $awardPhoto)
                        @include('render-image', ['photo' => $awardPhoto, 'class' => ['me-2', 'mb-2',
                        'd-inline-block']])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
