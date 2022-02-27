@php
    $lastPagePhoto = getImagesFromPath($resourceData, 'lastPage.photo', []);
@endphp
<div class="last-page"
    style="background-image: url('/imgc/a4mw/{{ data_get($lastPagePhoto, '0.name', null) }}')">
    <div class="page-info">
        <div class="details">@t($resourceData, 'lastPage.details', '')</div>
    </div>
</div>
