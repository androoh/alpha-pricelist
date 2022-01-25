<div class="layout-2 pt-2">
    @php
        $photoGallery = data_get($productSection, 'photo_gallery', []);
        $photoGalleryUrls = [];
        foreach ($photoGallery as $photo) {
            $photoUrl = data_get($photo, 'name', false);
            if ($photoUrl) {
                $photoGalleryUrls[] = $photoUrl;
            }
        }
    @endphp
    <span style="color: #fff; font-size:1px">ok</span>
    <div class="photo-gallery-3">
        @php
            $i = 0;
            $totalCount = 0;
            $total = count($photoGalleryUrls);
            $colClass = $total === 1 ? 'col' : 'col-4';
        @endphp
        @foreach ($photoGalleryUrls as $url)
            @php
                $i++;
                $totalCount++;
            @endphp
            @if ($i === 1)
                <div class="row" style="page-break-inside: avoid;">
            @endif
                    <div class="{{$colClass}} @if ($i === 1) pe-2 @endif @if ($i === 3) ps-2 @endif @if ($i === 2) ps-1 pe-1 @endif">
                        <img src="/imgc/a4mw/{{ $url }}" />
                    </div>
            @if ($i === 3 || $totalCount === count($photoGalleryUrls))
                </div>
            @endif
            @php
                if ($i === 3 || $totalCount === count($photoGalleryUrls)) {
                    $i = 0;
                }
            @endphp
        @endforeach
    </div>
</div>
