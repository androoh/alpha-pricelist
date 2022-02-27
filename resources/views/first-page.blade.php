@php
    $firstPagePhoto = getImagesFromPath($resourceData, 'firstPage.photo', null);
@endphp
<div class="first-page"
    @if (data_get($firstPagePhoto, '0.name', null))style="background-image: url('/imgc/a4mw/{{ data_get($firstPagePhoto, '0.name', null) }}')"@endif>
    <div class="page-info">
        <div class="year text-end">{{ data_get($resourceData, 'year', '2021') }}</div>
    </div>
</div>
