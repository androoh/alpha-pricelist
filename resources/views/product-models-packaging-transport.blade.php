@php
    $i = 0;
    $pageBreakBefore = data_get($product, 'mainProductFields.packagingTransportNewPage', 'yes');
@endphp
@foreach (data_get($product, 'mainProductFields.product_models', []) ?? [] as $productModel)
    @php
        $productModelData = null;
        $packagingTransport = null;
        $urls = [];
        $urlsAdditional = [];
        $packagingImages = [];
        $packagingImagesAdditional = [];
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
                }
                $partsAdditional = data_get($packagingTransportAdditional, 'parts', []);
                if ($packagingTransportAdditional) {
                    $packagingImagesAdditional = data_get($packagingTransportAdditional, 'technical_design', []) ?? [];
                }
            }
        }
    @endphp
    @if (($packagingTransport && (count($parts) > 0 || count($packagingImages) > 0)) || ($packagingTransportAdditional && (count($partsAdditional) > 0 || count($packagingImagesAdditional) > 0)))
        <div class="packaging-transport @if($i === 0 && $pageBreakBefore === 'yes') page-break-before @endif">
            <div class="packaging-transport-item mb-3 page-break-inside-avoid">
                <div class="packaging-transport-title pt-1 ps-2 pb-1 mb-2">
                    Model - @t($productModelData, 'name', '')
                </div>
                @if($packagingTransport)
                    <div class="mb-4">
                        @include('model-packaging-transport', [
                            'packagingTransport' => $packagingTransport,
                            'photos' => $packagingImages,
                            'parts' => $parts
                        ])
                    </div>
                @endif
                @if($packagingTransportAdditional)
                    <div class="mb-2">
                        @include('model-packaging-transport', [
                            'packagingTransport' => $packagingTransportAdditional,
                            'photos' => $packagingImagesAdditional,
                            'parts' => $partsAdditional
                        ])
                    </div>
                @endif
            </div>
        </div>
        @php
             $i++;
        @endphp
    @endif
@endforeach
