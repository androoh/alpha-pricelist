@php
if ($photo) {
    $photoUrl = data_get($photo, 'name', null);
    $path = data_get($photo, 'path', '');
    if (is_array($path)) {
        $path = '';
    }
    $pathInfo = pathinfo($path) ?? [];
    if (isset($pathInfo['extension']) && $pathInfo['extension'] === 'pdf') {
        $photoUrl = null;
    }
    $widthAttr = $width ?? null;
    $heightAttr = $height ?? null;
    $backgroundSizeAttr = $backgroundSize ?? null;
    $typeAttr = $type ?? 'img';
    $positionAttr = $position ?? '';
    $contentAttr = $content ?? null;
    $classes = isset($class) && !is_null($class) && is_array($class) ? implode(' ', $class) : '';
    $widthValue = data_get($photo, 'width', $widthAttr);
    $heightValue = data_get($photo, 'height', $heightAttr);
    $backgroundSizeValue = data_get($photo, 'backgroundSize', $backgroundSizeAttr);
    $typeValue = data_get($photo, 'type', $typeAttr);
    $positionValue = data_get($photo, 'position', $positionAttr);
}
@endphp
@if ($photo && $photoUrl)
    @if ($typeValue === 'img')
        <img style="@if ($widthValue)width:{{ $widthValue }} !important;@endif @if ($heightValue)height:{{ $heightValue }} !important;@endif @if (isset($style) && $style) {{ $style }} @endif" src="/imgc/a4mw/{{ $photoUrl }}" class="{{ $classes }}" />
    @endif
    @if ($typeValue === 'cropped')
        <div class="img-cropped {{ $classes }}" style="@if ($widthValue)width:{{ $widthValue }} !important;@endif @if ($backgroundSizeValue)background-size: {{ $backgroundSizeValue }}; @endif @if ($heightValue)height:{{ $heightValue }} !important;@endif @if ($positionValue)background-position: {{ $positionValue }};@endif background-image: url('/imgc/a4mw/{{ $photoUrl }}'); @if (isset($style) && $style) {{ $style }} @endif">
            @if ($contentAttr)
                {!! $contentAttr !!}
            @endif
        </div>
    @endif
@endif
