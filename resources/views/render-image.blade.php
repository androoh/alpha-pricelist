
@php
    $photoUrl = $photo ? data_get($photo, 'name', null) : null;
    $pathInfo = $photo ? pathinfo(data_get($photo, 'path', null)) : [];
    if (isset($pathInfo['extension']) && $pathInfo['extension'] === 'pdf') {
        $photoUrl = null;
    }
    $classes = isset($class) && !is_null($class) ? implode(' ', $class) : '';
    $width = $photo ? data_get($photo, 'width', null) : null;
    $height = $photo ? data_get($photo, 'height', null) : null;
@endphp
@if($photoUrl)
    <img style="@if($width)width:{{$width}} !important;@endif @if($height)height:{{$height}} !important;@endif" src="/imgc/a4mw/{{$photoUrl}}" class="{{$classes}}"/>
@endif
