@extends('layouts.app')
@section('styles')
    <style>
        @media print {
            @page :first {
                margin: 0;
                padding: 0;
            }
        }
    </style>
@endsection
@section('content')
    @php
        $productTree = [];
        $optionsAndAccessoriesPage = data_get($resourceData, 'optionsAndAccessoriesPage', false);
        $currency = data_get($resourceData, 'currency', 'EUR');
        setGlobalCurrency($currency);
    @endphp
    @include('first-page', ['resourceData' => $resourceData])
    @include('second-page', ['resourceData' => $resourceData])
    @include('toc-page', ['resourceData' => $resourceData])
    @include('info-icons-page', ['resourceData' => $resourceData])
    @foreach(data_get($resourceData, 'mainProductsPage.categories', []) as $treeItem)
        @include('category', ['treeItem' => $treeItem])
    @endforeach
    @include('options-accessories-page', ['resourceData' => $resourceData])
    @include('delivery-installation', ['resourceData' => $resourceData])
    @include('last-page', ['resourceData' => $resourceData])
@endsection
