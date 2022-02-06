<div class="icons-page-left page-break-before"
    style="background-image: url('/imgc/a4lh/{{ data_get($resourceData, 'iconsPage.photo_left_page.0.name', null) }}')">
    <div class="page-info">
        <h2 class="title p-0 m-0">@t($resourceData, 'iconsPage.title', 'Title placeholder')</h2>
        <div class="short-description p-0 m-0">@t($resourceData, 'iconsPage.short_description', 'Title placeholder')</div>
    </div>
</div>
<div class="icons-page-right">
    @php
        $infoIcons = [];
        $infoIconIds = [];
        foreach(data_get($resourceData, 'mainProductsPage.categories') as $treeItem) {
            foreach (data_get($treeItem, 'main_products', []) as $product) {
                if ($productId = data_get($product, 'id', false)) {
                    if ($productData = \App\Models\Product::find($productId)) {
                        $infoIconIds = array_merge($infoIconIds, data_get($productData, 'mainProductFields.info_icons', []));
                    }
                }
            }
        }
        if (count($infoIconIds) > 0) {
            $infoIcons = \App\Models\InfoIcon::find($infoIconIds) ?? [];
        }
    @endphp
    <table style="height: 100%; width: 100%;">
        <tr>
            <td class="w-50" style="vertical-align: top;">
                @if(count($infoIcons) > 0)
                    <table>
                        @foreach($infoIcons as $infoIcon)
                            <tr>
                                <td class="text-center pb-2"><img
                                        src="/imgc/a4lh/{{data_get($infoIcon, 'iconPhoto.0.name', null)}}"
                                        class="info-icon-img"/></td>
                                <td style="vertical-align: top;" class="pb-2">
                                    <div
                                        class="info-icon-description text-start ms-2 me-2">@t($infoIcon,
                                        'description', '-')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </td>
            <td class="w-50">
                <div class="background-image"
                     style="background-image: url('/imgc/a4lw/{{data_get($resourceData, 'iconsPage.photo_right_page.0.name', null)}}')"></div>
            </td>
        </tr>
    </table>
</div>
