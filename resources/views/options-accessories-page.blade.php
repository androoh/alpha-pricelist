@php
$optionsAndAccessoriesPage = data_get($resourceData, 'optionsAndAccessoriesPage', false);
$leftPathPhoto = getImagesFromPath($optionsAndAccessoriesPage, 'left_page_photo');
$rightPathPhoto = getImagesFromPath($optionsAndAccessoriesPage, 'right_page_photo');
@endphp
@if ($optionsAndAccessoriesPage)
    <div class="category-page-left"
        style="background-image: url('/imgc/a4lw/{{ data_get($leftPathPhoto, '0.name') }}')">
    </div>
    <div class="category-page-right"
        style="background-image: url('/imgc/a4lw/{{ data_get($rightPathPhoto, '0.name') }}')">
        <div class="title">@t($optionsAndAccessoriesPage, 'title')</div>
    </div>
    <div class="product-options-page">
        <div class="left-header">
        </div>
        <div class="right-header">
            <div class="d-flex justify-content-end">
                <div class="category-name">{{__(data_get($resourceData, 'type', 'Trade'))}}</div>
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
        @include('product-sections', ['categoryId' => null, 'parentProduct' => null, 'productSections' =>
        data_get($optionsAndAccessoriesPage, 'product_options_sections', []), 'prices' => data_get($resourceData,
        'prices',
        [])])
    </div>
@endif
