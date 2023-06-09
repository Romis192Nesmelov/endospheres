@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1>{{ trans('content.search_results',['searching' => $data['searching']]) }}</h1>
            @foreach($data['found'] as $found)
                <a href="{{ $found['href'] }}"><h2>{{ $found['head'] }}</h2></a>
                @if ($found['text'])
                    <p>
                        @include('_cropped_content_block',[
                            'croppingContent' => $found['text'],
                            'length' => 300
                        ])
                    </p>
                @endif
            @endforeach

            {{ $data['found']->render() }}
        </div>
    </div>
@endsection