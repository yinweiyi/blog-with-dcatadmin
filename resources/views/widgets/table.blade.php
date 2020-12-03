<table {!! $attributes !!}>
    <thead>
    <tr>
        @foreach($headers as $header)
            <th>{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $row)
        <tr>
            @foreach($row as $item)
                @if(is_string($item))
                    <td>{!! $item !!}</td>
                @else
                    <td {!! $item->attributes() !!}>{!! $item->content() !!}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
