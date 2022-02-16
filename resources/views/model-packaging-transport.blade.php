@if(count($parts) > 0 || count($photos) > 0)
    <div class="packaging-transport-images">
        @foreach($photos as $photo)
            @include('render-image', ['photo' => $photo, 'class' => ['d-block', 'packaging-transport-image', 'w-100']])
        @endforeach
    </div>
    @if(count($parts) === 1)
        @foreach($parts as $part)
            <table class="packaging-transport-info border-bottom mt-2">
                <thead>
                <tr>
                    <th></th>
                    <th class="text-start">{{__('Depth')}}</th>
                    <th class="text-center">{{__('Width')}}</th>
                    <th class="text-center">{{__('Height')}}</th>
                    <th class="text-end">{{__('Weight')}}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-start">
                        <div class="packaging-transport-label">{{__('Packaging & Transport')}}</div>
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
                    <div class="packaging-transport-label">{{__('Packaging & Transport')}}</div>
                </th>
                <th class="text-start">{{__('Depth')}}</th>
                <th class="text-center">{{__('Width')}}</th>
                <th class="text-center">{{__('Height')}}</th>
                <th class="text-end">{{__('Weight')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($parts as $part)
                <tr>
                    <td class="text-start">
                        @if($loop->index === 0)
                            <div class="packaging-notice">{{__('divided into :count_parts parts', ['count_parts' => count($parts)])}}</div>
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
