@php
$deliveryInstallationPage = data_get($resourceData, 'deliveryInstallationPage', []);
$prices = data_get($resourceData, 'prices', []);
$formatType = data_get($deliveryInstallationPage, 'priceType', null);
$deliveryDetails = translateFromPath($deliveryInstallationPage, 'delivery_details', '');
$optionsAndAccessoriesPage = data_get($resourceData, 'optionsAndAccessoriesPage', false);
$result = [];
foreach (data_get($resourceData, 'mainProductsPage.categories', []) as $treeItem) {
    $category = null;
    $categoryId = data_get($treeItem, 'category', null);
    if ($categoryId) {
        $category = \App\Models\Category::find($categoryId);
        if ($category) {
            foreach ($treeItem['main_products'] as $mainProduct) {
                $product = null;
                $productId = data_get($mainProduct, 'id', null);
                $hasInstalationDeliveryCosts = false;
                if ($productId) {
                    $product = \App\Models\Product::find($productId);
                    $hasInstalationDeliveryCosts = data_get($product, 'mainProductFields.price_options.has_instalation_delivery_costs', false);
                    if ($hasInstalationDeliveryCosts) {
                        if (!isset($result[$categoryId])) {
                            $result[$categoryId] = [
                                'category' => $category,
                                'items' => [],
                            ];
                        }
                        $deliveryCostDetails = translateFromPath($product, 'mainProductFields.price_options.delivery_cost_details', '');
                        $price = data_get($prices, getPriceKey($categoryId, $product), ['delivery_price' => 0, 'installation_price' => 0]);
                        $result[$categoryId]['items'][] = [
                            'product' => $product,
                            'price' => $price,
                            'deliveryCostDetails' => $deliveryCostDetails,
                        ];
                    }
                }
            }
        }
    }
}
@endphp
<div class="product-options-page page-break-before" id="delivery-installation">
    <div class="left-header">
    </div>
    <div class="right-header">
        <div class="d-flex justify-content-end">
            <div class="category-name">@t($resourceData, 'firstPage.type', 'Trade')</div>
        </div>
    </div>
    <div class="product-options-page-footer-left product-options-page-footer">
        <div class="page-counter"></div>
        <div class="footer-text-1">@t($optionsAndAccessoriesPage, 'footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($optionsAndAccessoriesPage, 'footer_text_2', '')</div>
        </div>
        <div class="footer-text-3">@t($optionsAndAccessoriesPage, 'footer_text_3', '')</div>
    </div>
    <div class="product-options-page-footer-right product-options-page-footer">
        <div class="footer-text-1">@t($optionsAndAccessoriesPage, 'footer_text_1', '')</div>
        <div class="footer-text-2">
            <div>@t($optionsAndAccessoriesPage, 'footer_text_2', '')</div>
        </div>
        <div class="footer-text-3">@t($optionsAndAccessoriesPage, 'footer_text_3', '')</div>
        <div class="page-counter"></div>
    </div>
    <div class="delivery-installation repeating-container">
        <div class="text-center text-uppercase repeating-header" style="font-size: 15pt">
            DELIVERY & INSTALLATION</div>
        <div class="repeating-container-body">
            <table class="options-table w-100 mb-2 repeating-container">
                <thead class="repeating-header">
                    <tr style="border-bottom: 2pt #4D545E solid;">
                        <th>Description</th>
                        <th>Installation costs</th>
                        <th>Delivery Costs <span class="delivery-details fst-italic">{{ $deliveryDetails }}</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="repeating-container-body">
                    @foreach ($result as $categoryId => $item)
                        <tr>
                            <td colspan="3">
                                <h3 class="mb-0">@t($item['category'], 'name', '')</h3>
                            </td>
                        </tr>
                        @foreach ($item['items'] as $productItem)
                            @php
                                $installationPriceOnDemand = data_get($productItem, 'price.installation_price_on_demand', false);
                                $deliveryPriceOnDemand = data_get($productItem, 'price.delivery_price_on_demand', false);
                                $installationPrice = data_get($productItem, 'price.installation_price', 0);
                                $deliveryPrice = data_get($productItem, 'price.delivery_price', 0);
                            @endphp
                            <tr>
                                <td class="text-start" style="width: 50% !important;">
                                    @t($productItem['product'], 'name','')
                                </td>
                                <td class="fw-bold text-center" style="width: 20% !important;">
                                    @if ($installationPriceOnDemand)
                                        on demand
                                    @else
                                        @price($installationPrice * 100, $formatType)
                                    @endif
                                </td>
                                <td class="fw-bold" style="width: 30% !important;">
                                    @if ($deliveryPriceOnDemand)
                                        on demand
                                    @else
                                        @price($deliveryPrice * 100, $formatType)
                                        {{ $productItem['deliveryCostDetails'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('additional-costs', ['resourceData' => $resourceData])
</div>
