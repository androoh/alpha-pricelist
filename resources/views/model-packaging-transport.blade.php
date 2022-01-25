@if(count($parts) > 0 || count($urls) > 0)
    <div class="packaging-transport-images">
        @foreach($urls as $url)
            <img src="/imgc/a4lw/{{$url}}"
            class="d-block packaging-transport-image"
            style="
            width: 85%;
            margin: 0 auto;
            "/>
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
@endif