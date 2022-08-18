@php
$category = null;
$categoryId = data_get($treeItem, 'category', null);
if ($categoryId) {
    $category = \App\Models\Category::find($categoryId);
}
$leftPagePhoto = getImagesFromPath($treeItem, 'left_page_photo');
$rightPagePhoto = getImagesFromPath($treeItem, 'right_page_photo');
@endphp
@if ($category)
    @if (data_get($leftPagePhoto, '0.name'))
        <div class="category-page-left"
            style="background-image: url('{{url('/imgc/a4lw/'.data_get($leftPagePhoto, '0.name')) }}')">
        </div>
    @endif
    @if (data_get($rightPagePhoto, '0.name'))
        <div class="category-page-right"
            style="background-image: url('{{url('/imgc/a4lw/'.data_get($rightPagePhoto, '0.name')) }}')">
            <div class="title">@t($treeItem, 'title')</div>
        </div>
    @endif
    @foreach ($treeItem['main_products'] as $mainProduct)
        @php
            $product = null;
            $productId = data_get($mainProduct, 'id', null);
            if ($productId) {
                $product = \App\Models\Product::find($productId);
            }
        @endphp
        @if ($product)
            @include('product', [
                'treeItem' => $treeItem,
                'categoryId' => $categoryId,
                'product' => $product,
                'resourceData' => $resourceData,
                'category' => $category,
            ])
        @endif
    @endforeach
    @php
        $productSections = data_get($treeItem, 'product_options_sections', []) ?? [];
        $pricelistType = data_get($resourceData, 'type', 'Trade');
        $pricelistTypeAcr = $pricelistType === 'Trade' ? 'TP' : 'RP';
    @endphp
    @if (count($productSections) > 0)
        <div class="product-page">
            @include('product-sections', [
                'categoryId' => $categoryId,
                'parentProduct' => null,
                'pricelistTypeAcr' => $pricelistTypeAcr,
                'productSections' => $productSections,
                'prices' => data_get($resourceData, 'prices', []),
            ])
        </div>
    @endif
@endif
