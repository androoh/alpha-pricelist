<div class="packaging-transport">
    @foreach (data_get($product, 'mainProductFields.product_models', []) ?? [] as $productModel)
        @php
            $productModelData = null;
            $packagingTransport = null;
            $productOptionId = data_get($productModel, 'id', false);
            $parts = [];
            if ($productOptionId) {
                $productModelData = \App\Models\Product::find($productOptionId);
                if ($productModelData) {
                    $packagingTransport = data_get($productModelData, 'modelProductFields.packagingTransport', null);
                    $parts = data_get($packagingTransport, 'parts', []);
                }
            }
        @endphp
        @if($packagingTransport && count($parts) > 0)
            <div class="packaging-transport-item mb-3 page-break-inside-avoid">
                @php
                    $packagingImages = data_get($packagingTransport, 'technical_design', []) ?? [];
                    $urls = [];
                    foreach ($packagingImages as $image) {
                        $path = data_get($image, 'name', '');
                        $pathInfo = pathinfo($path);
                        if ($path && $pathInfo['extension'] !== 'pdf') {
                            $urls[] = $path;
                        }
                    }
                @endphp
                <div class="packaging-transport-title pt-1 ps-2 pb-1 mb-2">
                    Model - @t($productModelData, 'name', '')
                </div>
                <div class="packaging-transport-images">
                    @foreach($urls as $url)
                        <img src="/imgc/a4lw/{{$url}}" class="d-block w-100 packaging-transport-image"/>
                    @endforeach
                </div>
                @if(count($parts) === 1)
                    @foreach($parts as $part)
                        <table class="packaging-transport-info border-bottom mt-2">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-start">Depth</th>
                                <th class="text-center">Width</th>
                                <th class="text-center">Height</th>
                                <th class="text-end">Weight</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-start">
                                    <div class="packaging-transport-label">Packaging & Transport</div>
                                </td>
                                <td class="text-start">{{data_get($part, 'depth', '-')}} cm</td>
                                <td class="text-center">{{data_get($part, 'width', '-')}} cm</td>
                                <td class="text-center">{{data_get($part, 'height', '-')}} cm</td>
                                <td class="text-end">{{data_get($part, 'weight', '-')}} kg</td>
                            </tr>
                            </tbody>
                        </table>
                    @endforeach
                @elseif(count($parts) > 1)
                    <table class="packaging-transport-info">
                        <thead>
                        <tr class="border-bottom">
                            <th class="text-start">
                                <div class="packaging-transport-label">Packaging & Transport</div>
                            </th>
                            <th class="text-start">Depth</th>
                            <th class="text-center">Width</th>
                            <th class="text-center">Height</th>
                            <th class="text-end">Weight</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($parts as $part)
                            <tr>
                                <td class="text-start">
                                    @if($loop->index === 0)
                                        <div class="packaging-notice">divided into {{count($parts)}} parts</div>
                                    @endif
                                </td>
                                <td class="text-start">{{data_get($part, 'depth', '-')}} cm</td>
                                <td class="text-center">{{data_get($part, 'width', '-')}} cm</td>
                                <td class="text-center">{{data_get($part, 'height', '-')}} cm</td>
                                <td class="text-end">{{data_get($part, 'weight', '-')}} kg</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @elseif($otherInfo = translateFromPath($packagingTransport, 'other_info', false))
                    <div class="packaging-transport-info border-bottom">
                        <div class="packaging-transport-label">{{$otherInfo}}</div>
                    </div>
                @endif
            </div>
        @endif
    @endforeach
</div>
