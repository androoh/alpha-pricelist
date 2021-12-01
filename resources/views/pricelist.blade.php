@extends('layouts.app')
@section('styles')
    <style>
        @media print {
            @page {
                size: {{$pageSize}} {{$pageOrientation}};
                margin: 36pt;
                @if ($showCropBorders || $showCross)
                     marks: @if($showCropBorders) crop @endif @if($showCross) cross @endif;
                @endif
            }
        }
    </style>
@endsection
@section('content')
    @php
        $productTree = [];
        $infoIconIds = [];
        foreach(data_get($priceList, 'mainProductsPage.categories') as $treeItem) {
            foreach (data_get($treeItem, 'main_products', []) as $product) {
                if ($productId = data_get($product, 'id', false)) {
                    if ($productData = \App\Models\Product::find($productId)) {
                        $infoIconIds = array_merge($infoIconIds, data_get($productData, 'mainProductFields.info_icons', []));
                    }
                }
            }
        }
        $optionsAndAccessoriesPage = data_get($priceList, 'optionsAndAccessoriesPage', false);
        $currency = data_get($priceList, 'currency', 'EUR');
        setGlobalCurrency($currency);
    @endphp
    <div class="first-page"
         style="background-image: url('/imgc/a4mw/{{data_get($priceList, 'firstPage.photo.0.name', null)}}')">
        <div class="page-info">
            <div class="title">@t($priceList, 'firstPage.name', 'Price list')</div>
            <div class="type">@t($priceList, 'firstPage.type', 'Trade')</div>
            <div class="language">@t($priceList, 'firstPage.language', 'En')</div>
        </div>
    </div>
    <div class="second-page"
         style="background-image: url('/imgc/a4mw/{{data_get($priceList, 'secondPage.photo.0.name', null)}}')">
        <div class="page-info">
            <h2 class="title p-0 m-0">@t($priceList, 'secondPage.title', 'Title placeholder')</h2>
            <div class="short-description p-0 m-0">@t($priceList, 'secondPage.short_description', 'Title placeholder')</div>
        </div>
    </div>
    <div class="toc-page">
        <h1>Table of <strong>CONTENTS</strong></h1>
        <div class="columns-count-2">
            @foreach(data_get($priceList, 'mainProductsPage.categories') as $treeItem)
                @php
                    $category = null;
                    $categoryId = data_get($treeItem, 'category', null);
                    if ($categoryId) {
                        $category = \App\Models\Category::find($categoryId);
                    }
                @endphp
                @if($category)
                    <div class="category-section mb-2 page-break-inside-avoid">
                        <h3 class="category-title">@t($category, 'name', '')</h3>
                        @foreach($treeItem['main_products'] as $mainProduct)
                            @php
                                $product = null;
                                $productId = data_get($mainProduct, 'id', null);
                                if ($productId) {
                                    $product = \App\Models\Product::find($productId);
                                }
                            @endphp
                            <div class="category-item"><a
                                    href="#product-{{$product->getKey()}}">@t($product, 'name', '')</a></div>
                        @endforeach
                    </div>
                @endif
            @endforeach
            <div class="category-section mb-2 page-break-inside-avoid">
                <h3 class="category-title">@t($optionsAndAccessoriesPage, 'title')</h3>
                @php
                    $prevHash = null;
                @endphp
                @foreach(data_get($optionsAndAccessoriesPage, 'product_options_sections', []) as $productSection)
                    @php
                        $productSectionTitle = translateFromPath($productSection, 'title', false);
                        $hash = md5($productSectionTitle);
                    @endphp
                    @if($productSectionTitle && $hash !== $prevHash)
                        <div class="category-item"><a
                                href="#product-{{$hash}}">{{$productSectionTitle}}</a></div>
                    @endif
                    @php
                        $prevHash = $hash;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
    <div class="icons-page-left page-break-before"
         style="background-image: url('/imgc/a4lh/{{data_get($priceList, 'iconsPage.photo_left_page.0.name', null)}}')">
        <div class="page-info">
            <h2 class="title p-0 m-0">@t($priceList, 'iconsPage.title', 'Title placeholder')</h2>
            <div class="short-description p-0 m-0">@t($priceList, 'iconsPage.short_description', 'Title placeholder')</div>
        </div>
    </div>
    <div class="icons-page-right">
        @php
            $infoIcons = [];
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
                         style="background-image: url('/imgc/a4lw/{{data_get($priceList, 'iconsPage.photo_right_page.0.name', null)}}')"></div>
                </td>
            </tr>
        </table>
    </div>
    @foreach(data_get($priceList, 'mainProductsPage.categories') as $treeItem)
        @php
            $category = null;
            $categoryId = data_get($treeItem, 'category', null);
            if ($categoryId) {
                $category = \App\Models\Category::find($categoryId);
            }
        @endphp
        @if($category)
            <div class="category-page-left"
                 style="background-image: url('/imgc/a4lw/{{data_get($treeItem, 'left_page_photo.0.name')}}')">
            </div>
            <div class="category-page-right"
                 style="background-image: url('/imgc/a4lw/{{data_get($treeItem, 'right_page_photo.0.name')}}')">
                <div class="title">@t($treeItem, 'title')</div>
            </div>
            @foreach($treeItem['main_products'] as $mainProduct)
                @php
                    $product = null;
                    $productId = data_get($mainProduct, 'id', null);
                    if ($productId) {
                        $product = \App\Models\Product::find($productId);
                    }
                @endphp
                @include('product', ['product' => $product, 'priceList' => $priceList, 'category' => $category])
            @endforeach
            @include('product-sections', ['productSections' => data_get($treeItem, 'product_options_sections', []), 'prices' => data_get($priceList, 'prices', [])])
        @endif
    @endforeach
    @if ($optionsAndAccessoriesPage)
        <div class="category-page-left"
             style="background-image: url('/imgc/a4lw/{{data_get($optionsAndAccessoriesPage, 'left_page_photo.0.name')}}')">
        </div>
        <div class="category-page-right"
             style="background-image: url('/imgc/a4lw/{{data_get($optionsAndAccessoriesPage, 'right_page_photo.0.name')}}')">
            <div class="title">@t($optionsAndAccessoriesPage, 'title')</div>
        </div>
        <div class="product-options-page">
            <div class="left-header">
            </div>
            <div class="right-header">
                <div class="d-flex justify-content-end">
                    <div class="category-name">@t($priceList, 'firstPage.type', 'Trade')</div>
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
            @include('product-sections', ['productSections' => data_get($optionsAndAccessoriesPage, 'product_options_sections', []), 'prices' => data_get($priceList, 'prices', [])])
        </div>
    @endif
@endsection
