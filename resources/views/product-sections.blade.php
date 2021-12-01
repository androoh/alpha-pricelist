<div class="product-sections">
    @foreach($productSections as $productSection)
        @php
            $productSectionTitle = translateFromPath($productSection, 'title', false);
            $hash = md5($productSectionTitle);
            $hideTitle = data_get($productSection, 'hideTitle', false);
        @endphp
        <div class="product-section mb-4 w-100 repeating-container" id="product-{{$hash}}">
            @if($productSectionTitle && !$hideTitle)
                <div
                    class="product-section-title text-center text-uppercase repeating-header">{{$productSectionTitle}}</div>
            @endif
            <div class="repeating-container-body">
                @switch(data_get($productSection, 'layout', 'layout1'))
                    @case('layout1')
                    @include('product-sections.layout1', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout2')
                    @include('product-sections.layout2', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout3')
                    @include('product-sections.layout3', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout5')
                    @include('product-sections.layout5', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout6')
                    @include('product-sections.layout6', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout7')
                    @include('product-sections.layout7', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout8')
                    @include('product-sections.layout8', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout11')
                    @include('product-sections.layout11', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout12')
                    @include('product-sections.layout12', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout13')
                    @include('product-sections.layout13', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout14')
                    @include('product-sections.layout14', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @case('layout15')
                    @include('product-sections.layout15', ['productSection' => $productSection, 'prices' => $prices])
                    @break
                    @default
                @endswitch
            </div>
        </div>
    @endforeach
</div>
