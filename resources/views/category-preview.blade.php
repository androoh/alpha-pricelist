@extends('layouts.app')
@section('styles')
    <style>
        @media print {
            @page {
                size: {{ $pageSize }} {{ $pageOrientation }};
                margin: 36pt;
                @if ($showCropBorders || $showCross)marks: @if ($showCropBorders) crop @endif @if ($showCross) cross @endif;
                @endif
            }
        }

    </style>
@endsection
@section('content')
    @if ($treeItem)
        @include('category', ['treeItem' => $treeItem])
    @else
        Wrong Category
    @endif
@endsection
