@php
$optionsAndAccessoriesPage = data_get($resourceData, 'optionsAndAccessoriesPage', false);
@endphp
<div class="toc-page">
    <h1>{!!__('Table of CONTENTS')!!}</h1>
    <div class="columns-count-2">
        @foreach (data_get($resourceData, 'mainProductsPage.categories', []) as $treeItem)
            @php
                $category = null;
                $categoryId = data_get($treeItem, 'category', null);
                if ($categoryId) {
                    $category = \App\Models\Category::find($categoryId);
                }
            @endphp
            @if ($category)
                <div class="category-section mb-2">
                    <h3 class="category-title">@t($category, 'name', '')</h3>
                    @foreach ($treeItem['main_products'] as $mainProduct)
                        @php
                            $product = null;
                            $productId = data_get($mainProduct, 'id', null);
                            if ($productId) {
                                $product = \App\Models\Product::find($productId);
                            }
                        @endphp
                        <div class="category-item"><a href="#product-{{ $product->getKey() }}">@t($product, 'name',
                                '')</a></div>
                    @endforeach
                </div>
            @endif
        @endforeach
        <div class="category-section mb-2 page-break-inside-avoid">
            <h3 class="category-title">@t($optionsAndAccessoriesPage, 'title')</h3>
            @php
                $prevHash = null;
            @endphp
            @foreach (data_get($optionsAndAccessoriesPage, 'product_options_sections', []) as $productSection)
                @php
                    $hideInToc = data_get($productSection, 'hideInToc', false);
                    $productSectionTitle = translateFromPath($productSection, 'title', false);
                    $hash = md5($productSectionTitle);
                @endphp
                @if ($productSectionTitle && $hash !== $prevHash && !$hideInToc)
                    <div class="category-item"><a href="#product-{{ $hash }}">{{ $productSectionTitle }}</a>
                    </div>
                @endif
                @php
                    $prevHash = $hash;
                @endphp
            @endforeach
        </div>
        @if (!$hidePrices)
        <div class="category-section mb-2 page-break-inside-avoid">
            <h3 class="category-item"><a href="#delivery-installation">{{__('Delivery & Installation')}}</a></h3>
        </div>
        @endif
    </div>
</div>
