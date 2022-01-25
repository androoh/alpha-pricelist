@php
    $i = 0;
@endphp
@foreach (data_get($product, 'mainProductFields.product_models', []) ?? [] as $productModel)
    @php
        $productModelData = null;
        $packagingTransport = null;
        $urls = [];
        $urlsAdditional = [];
        $parts = [];
        $partsAdditional = [];
        $productOptionId = data_get($productModel, 'id', false);
        if ($productOptionId) {
            $productModelData = \App\Models\Product::find($productOptionId);
            if ($productModelData) {
                $packagingTransport = data_get($productModelData, 'modelProductFields.packagingTransport', null);
                $packagingTransportAdditional = data_get($productModelData, 'modelProductFields.packagingTransportAdditional', null);
                $parts = data_get($packagingTransport, 'parts', []);
                if ($packagingTransport) {
                    $packagingImages = data_get($packagingTransport, 'technical_design', []) ?? [];
                    foreach ($packagingImages as $image) {
                        $path = data_get($image, 'name', '');
                        $pathInfo = pathinfo($path);
                        if ($path && $pathInfo['extension'] !== 'pdf') {
                            $urls[] = $path;
                        }
                    }
                }
                $partsAdditional = data_get($packagingTransportAdditional, 'parts', []);
                if ($packagingTransportAdditional) {
                    $packagingImages = data_get($packagingTransportAdditional, 'technical_design', []) ?? [];
                    foreach ($packagingImages as $image) {
                        $path = data_get($image, 'name', '');
                        $pathInfo = pathinfo($path);
                        if ($path && $pathInfo['extension'] !== 'pdf') {
                            $urlsAdditional[] = $path;
                        }
                    }
                }
            }
        }
    @endphp
    @if (($packagingTransport && (count($parts) > 0 || count($urls) > 0)) || ($packagingTransportAdditional && (count($partsAdditional) > 0 || count($urlsAdditional) > 0)))
        <div class="packaging-transport @if($i === 0) page-break-before @endif">
            <div class="packaging-transport-item mb-3 page-break-inside-avoid">
                <div class="packaging-transport-title pt-1 ps-2 pb-1 mb-2">
                    Model - @t($productModelData, 'name', '')
                </div>
                @if($packagingTransport)
                    @include('model-packaging-transport', [
                        'packagingTransport' => $packagingTransport,
                        'urls' => $urls,
                        'parts' => $parts
                    ])
                @endif
                @if($packagingTransportAdditional)
                    @include('model-packaging-transport', [
                        'packagingTransport' => $packagingTransportAdditional,
                        'urls' => $urlsAdditional,
                        'parts' => $partsAdditional
                    ])
                @endif
            </div>
        </div>
        @php
             $i++;
        @endphp
    @endif
@endforeach
