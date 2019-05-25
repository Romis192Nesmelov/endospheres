<title>{{ $chapter['title'] ? $chapter['title'] : 'Endospheres therapy' }}</title>
@foreach($metas as $meta => $params)
    @if ($chapter[$meta])
        <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $chapter[$meta] }}">
    @endif
@endforeach