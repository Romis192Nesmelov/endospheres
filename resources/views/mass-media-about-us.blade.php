@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => $data['sub_chapter']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._secondary_menu_block',['items' => $data['chapter']->subChapters, 'prefix' => $data['chapter']->slug, 'activeId' => $data['sub_chapter']->id])
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['sub_chapter']->slide, 'title' => $data['sub_chapter']['slide_title_'.App::getLocale()], 'showLicense' => false])
                <div class="quote">{{ $data['sub_chapter']['subscribe_'.App::getLocale()] }}</div>
                @if (isset($data['years']) && count($data['years']))
                    <ul class="years">
                        @foreach ($data['years'] as $year)
                            <li><a href="/{{ $data['chapter']->slug.'/'.$data['sub_chapter']->slug.'/'.$year }}/" {{ $data['current_year'] == $year ? 'class=active' : '' }}>{{ $year }}</a></li>
                        @endforeach
                    </ul>
                    @if (count($data['mass_media']))
                        @foreach($data['mass_media'] as $mm)
                            <div class="mm-cover col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <a href="{{ asset($mm->full) }}" data-description="{{ $mm['description_'.App::getLocale()] }}" {{ !$mm->is_pdf ? 'data-popup=lightbox' : 'target=_blank' }}><img {!! $mm['preview_title_'.App::getLocale()] ? 'title="'.$mm['preview_title_'.App::getLocale()].'"' : '' !!} src="{{ asset($mm->preview) }}" /></a>
                            </div>
                        @endforeach
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {{ $data['mass_media']->render() }}
                        </div>
                    @endif
                @elseif (count($data['sub_chapter']->resources) && $data['sub_chapter']->id != 7)
                    @foreach($data['sub_chapter']->resources as $resource)
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <a href="{{ $resource->url }}" target="_blank">
                                <div class="resource-frame">
                                    <img {{ $resource['logo_title_'.App::getLocale()] ? 'title='.$resource['logo_title_'.App::getLocale()] : '' }} src="{{ $resource->logo }}" />
                                    <div>{{ $resource['description_'.App::getLocale()] }}</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @elseif (count($data['sub_chapter']->resources))
                    <div class="row black tv-adverts">
                        @foreach($data['sub_chapter']->resources as $video)
                            <h2>{{ $video['description_'.App::getLocale()] }}</h2>
                            @include('_video_block',['video' => $video, 'col' => 9, 'dontUseDescr' => true])
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection