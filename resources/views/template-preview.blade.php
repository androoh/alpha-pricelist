@extends('layouts.app')
@section('styles')
    <style>
        @media print {
            @page {
                size: {{$pageSize}} {{$pageOrientation}};
                @if ($showCropBorders || $showCross)
                     marks: @if($showCropBorders) crop @endif @if($showCross) cross @endif;
                @endif
            }
        }
    </style>
@endsection
@section('content')
    @if(View::exists($template))
        @include($template, ['treeItem' => $treeItem, 'resourceData' => $resourceData])
    @else
        Template doesn't exists
    @endif
@endsection
