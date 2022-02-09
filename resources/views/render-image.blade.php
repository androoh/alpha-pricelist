@php
$photoUrl = $photo ? data_get($photo, 'name', null) : null;
$path = $photo ? data_get($photo, 'path', '') : '';
if (is_array($path)) {
    $path = '';
}
$pathInfo = $photo ? pathinfo($path) : [];
if (isset($pathInfo['extension']) && $pathInfo['extension'] === 'pdf') {
    $photoUrl = null;
}
$classes = isset($class) && !is_null($class) ? implode(' ', $class) : '';
$width = $photo ? data_get($photo, 'width', null) : null;
$height = $photo ? data_get($photo, 'height', null) : null;
$backgroundSize = $photo ? data_get($photo, 'backgroundSize', null) : null;
$type = $photo ? data_get($photo, 'type', 'img') : 'img';
$position = $photo ? data_get($photo, 'position', 'left top') : 'left-top';
@endphp
@if ($photoUrl)
    @if ($type === 'img')
        <img style="@if ($width)width:{{ $width }} !important;@endif @if ($backgroundSize)background-size: {{$backgroundSize}}; @endif @if ($height)height:{{ $height }} !important;@endif @if (isset($style) && $style) {{ $style }} @endif" src="/imgc/a4mw/{{ $photoUrl }}" class="{{ $classes }}" />
    @endif
    @if ($type === 'cropped')
        <div class="img-cropped {{ $classes }}" style="@if ($width)width:{{ $width }} !important;@endif @if ($backgroundSize)background-size: {{$backgroundSize}}; @endif @if ($height)height:{{ $height }} !important;@endif @if ($position)background-position: {{ $position }};@endif background-image: url('/imgc/a4mw/{{ $photoUrl }}'); @if (isset($style) && $style) {{ $style }} @endif"></div>
    @endif
@endif
