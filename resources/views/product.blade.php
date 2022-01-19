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
    <div class="product-page-footer-left product-page-footer">
        <div class="page-counter"></div>
        <div class="footer-text-1">@t($priceList, 'mainProductsPage.footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($priceList, 'mainProductsPage.footer_text_2', '')</div>
            <div>@t($product, 'mainProductFields.footer_notes', '')</div>
        </div>
        <div class="footer-text-3">@t($priceList, 'mainProductsPage.footer_text_3', '')</div>
    </div>
    <div class="product-page-footer-right product-page-footer">
        <div class="footer-text-1">@t($priceList, 'mainProductsPage.footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($priceList, 'mainProductsPage.footer_text_2', '')</div>
            <div>@t($product, 'mainProductFields.footer_notes', '')</div>
        </div>
        <div class="footer-text-3">@t($priceList, 'mainProductsPage.footer_text_3', '')</div>
        <div class="page-counter"></div>
    </div>
    <div class="page-body">
        <table class="product-info mb-3">
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    @php
                        $mainPhotoUrl = data_get($product, 'mainProductFields.main_photo.0.name', false);
                        $mainPhotoInfoNote = translateFromPath($product, 'mainProductFields.main_photo_info_note', false);
                        $infoNote = translateFromPath($product, 'mainProductFields.info_note', false);
                        $clientSuply = translateFromPath($product, 'mainProductFields.client_suply', false);
                        $awardsPhotos = data_get($product, 'mainProductFields.awards_photos', []) ?? [];
                    @endphp
                    @if($mainPhotoUrl)
                        <div class="main-photo w-100 p-4">
                            <img src="/imgc/a4mw/{{$mainPhotoUrl}}" class="d-block w-100"/>
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
                        <div class="description mb-2">
                            @t($product, 'mainProductFields.standard_equipment', '')
                        </div>
                        @if ($clientSuply)
                        <div class="client-suply mb-2">
                            <strong>The client to supply:</strong>
                            {!!$clientSuply!!}
                        </div>
                        @endif
                        @if ($infoNote)
                        <div class="info-note mb-2 fst-italic fw-bolder">
                            <div>Info Note</div>
                            {!!$infoNote!!}
                        </div>
                        @endif
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
                            <img src="/imgc/a4lw/{{$infoIconUrl}}" style="height: 35pt"/>
                        @endforeach
                    </div>
                </td>
            </tr>
        </table>
        @include('product-models', ['categoryId' => $categoryId, 'product' => $product, 'prices' => data_get($priceList, 'prices', [])])
        @include('product-sections', ['categoryId' => $categoryId, 'parentProduct' => $product,'productSections' => data_get($product, 'mainProductFields.product_sections', []), 'prices' => data_get($priceList, 'prices', [])])
        @include('product-models-packaging-transport', ['product' => $product])
        @if (count($awardsPhotos) > 0)
            <div class="awards-photots-section page-break-inside-avoid">
                <h3>Winner</h3>
                <div class="awards-photots">
                @foreach ($awardsPhotos as $awardPhoto)
                    @php
                        $awardPhotoUrl = data_get($awardPhoto, 'name', false);
                    @endphp
                    @if($awardPhotoUrl)
                        <img src="/imgc/a4lw/{{$awardPhotoUrl}}" style="max-height: 100pt; display:inline-block;" class="me-2 mb-2"/>
                    @endif
                @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
