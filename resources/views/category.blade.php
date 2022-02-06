@php
$category = null;
$categoryId = data_get($treeItem, 'category', null);
if ($categoryId) {
    $category = \App\Models\Category::find($categoryId);
}
@endphp
@if ($category)
    @if (data_get($treeItem, 'left_page_photo.0.name'))
        <div class="category-page-left"
            style="background-image: url('/imgc/a4lw/{{ data_get($treeItem, 'left_page_photo.0.name') }}')">
        </div>
    @endif
    @if (data_get($treeItem, 'right_page_photo.0.name'))
        <div class="category-page-right"
            style="background-image: url('/imgc/a4lw/{{ data_get($treeItem, 'right_page_photo.0.name') }}')">
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
        @include('product', ['treeItem' => $treeItem, 'categoryId' => $categoryId, 'product' => $product, 'resourceData'
        => $resourceData, 'category'
        => $category])
    @endforeach
    <div class="product-page">
        @include('product-sections', ['categoryId' => $categoryId, 'parentProduct' => null, 'productSections' =>
        data_get($treeItem, 'product_options_sections', []), 'prices' => data_get($resourceData, 'prices', [])])
    </div>
@endif
