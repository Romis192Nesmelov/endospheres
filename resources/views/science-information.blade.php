@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => $data['chapter']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['chapter']->slide, 'title' => $data['chapter']['slide_title_'.App::getLocale()], 'showLicense' => false])
                <div class="quote">
                    {{ $data['chapter']['subscribe_'.App::getLocale()] }}
                    <a href="{{ asset('pdfs/lipodistrofie.pdf') }}" class="pull-right" target="_blank">{{ trans('content.read_more') }}</a>
                </div>
                @if (count($data['hrefs']))
                    <ul class="hrefs">
                        @foreach($data['hrefs'] as $href)
                            <li>
                                <a href="{{ $href['link'] }}" {{ $href['type'] == 'video' ? 'data-video=1' : ($href['type'] == 'image' ? 'data-popup=lightbox' : 'target=_blank') }}>
                                    <div class="href">{{ $href['head'] }}</div>
                                    <div class="label hidden-xs">
                                        <div>{!! $href['type'] == 'video' ? trans('content.play').'<div class="icon-utube"></div>' : ($href['type'] == 'image' ? trans('content.see').'<div class="icon-jpg"></div>' : trans('content.download').'<div class="icon-pdf"></div>') !!}</div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection