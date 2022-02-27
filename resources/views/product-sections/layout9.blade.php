<div class="layout-9 pt-2">
    @php
        $photoGallery = getImagesFromPath($productSection, 'photo_gallery', []) ?? [];
    @endphp
    <table class="w-100">
        <tbody>
        @php
            $i = 0;
            $totalCount = 0;
            $total = count($photoGallery);
        @endphp
        @foreach ($photoGallery as $photo)
            @php
                $i++;
                $totalCount++;
            @endphp
            @if ($i === 1)
                <tr>
            @endif
            <td class="w-50">
                <div class="mb-2 @if ($i === 1) pe-2 @endif @if ($i === 2) ps-2 @endif">
                    @include('render-image', ['photo' => $photo, 'class' => ['w-100', 'd-block']])
                </div>
            </td>
            @if ($i === 2 || $totalCount === count($photoGallery))
                </tr>
            @endif
            @php
                if ($i === 2) {
                    $i = 0;
                }
            @endphp
        @endforeach
        </tbody>
    </table>
</div>
