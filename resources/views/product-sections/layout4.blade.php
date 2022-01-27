<div class="layout-4 pt-2 photo-gallery-background">
    @php
        $photoGallery = data_get($productSection, 'photo_gallery', []) ?? [];
    @endphp
    @foreach ($photoGallery as $photo)
        @php
        $url = data_get($photo, 'name', false);
        $width = data_get($photo, 'width', null);
        $height = data_get($photo, 'height', null);
        @endphp
        @if($url)
        <div class="photo-gallery-item" style="@if($width)width:{{$width}} !important;@endif @if($height)height:{{$height}} !important;@endif background-image: url('/imgc/a4mw/{{$url}}');">
        </div>
        @endif
    @endforeach
</div>
