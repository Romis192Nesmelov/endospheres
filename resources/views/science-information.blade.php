@extends('layouts.main')

@section('content')
    @include('layouts._feedback_modal_block')
    <div class="row main">
        <div class="container">
            <h1 class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">{{ $data['chapter']['head_'.App::getLocale()] }}</h1>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">

            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['chapter']->slide])
                <div class="quote">
                    {{ $data['chapter']['content_'.App::getLocale()] }}
                    <a href="#"></a>
                </div>
                @if (count($data['hrefs']))
                    <ul class="hrefs">
                        @foreach($data['hrefs'] as $href)
                            <li>
                                <div><a href="{{ $href['link'] }}" data-video="{{ $href['is_video'] }}" target="_blank">{{ $href['head'] }}</a></div><div class="label"><div>{!! $href['is_video'] ? trans('content.play').'<div class="icon-utube"></div>' : trans('content.download').'<div class="icon-pdf"></div>' !!}</div></div></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection