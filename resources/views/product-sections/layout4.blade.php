<div class="layout-4 pt-2 photo-gallery-background">
    @php
        $photoGallery = getImagesFromPath($productSection, 'photo_gallery', []) ?? [];
    @endphp
    @foreach ($photoGallery as $photo)
        @php
        $url = data_get($photo, 'name', false);
        $width = data_get($photo, 'width', null);
        $height = data_get($photo, 'height', null);
        @endphp
        @include('render-image', ['photo' => $photo, 'class' => ['w-100', 'd-block']])
    @endforeach
</div>
