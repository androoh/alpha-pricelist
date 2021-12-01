<div class="layout-2">
    @php
        $photoGallery = data_get($productSection, 'photo_gallery', []);
        $photoGalleryUrls = [];
        foreach($photoGallery as $photo) {
            $photoUrl = data_get($photo, 'name', false);
            if ($photoUrl) {
                $photoGalleryUrls[] = $photoUrl;
            }
        }
    @endphp
    <div class="photo-gallery-3">
        <table>
            @php
                $i = 0;
            @endphp
            @foreach($photoGalleryUrls as $url)
                @php
                    $i++;
                @endphp
                @if($i === 1)
                    <tr class="page-break-inside-avoid">
                        @endif
                        <td class="@if($i === 1) pe-2 @endif @if($i === 3) ps-2 @endif @if($i === 2) ps-1 pe-1 @endif">
                            <div class="photo-gallery-item">
                                <img src="/imgc/a4mw/{{$url}}"/>
                            </div>
                        </td>
                        @if($i === 3)
                    </tr>
                @endif
                @php
                    if($i === 3) {
                        $i = 0;
                    }
                @endphp
            @endforeach
        </table>
    </div>


</div>
