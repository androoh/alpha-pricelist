@php
$secondPagePhoto = getImagesFromPath($resourceData, 'secondPage.photo', null);
@endphp
<div class="second-page" @if ($secondPagePhoto && data_get($secondPagePhoto, '0.name', null))style="background-image: url('{{url('/imgc/a4mw/'.data_get($secondPagePhoto, '0.name', null)) }}')"@endif>
    <div class="page-info">
        <h2 class="title p-0 m-0">@t($resourceData, 'secondPage.title', 'Title placeholder')</h2>
        <div class="short-description p-0 m-0">@t($resourceData, 'secondPage.short_description', 'Title placeholder')
        </div>
    </div>
</div>
