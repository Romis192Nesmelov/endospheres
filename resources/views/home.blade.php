@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="container">
            @foreach($data['devices'] as $k => $device)
                @include('_href_image_block', [
                    'href' => '/devices/'.$device->slug,
                    'width' => (!$k || !$k%3 ? '19%' : '39%'),
                    'image' => asset('images/'.$device->home_page_image),
                    'title' => $device['home_page_image_title_'.App::getLocale()],
                    'description' => '<span>'.trans('content.endosphere').'</span> '.$device['head_'.App::getLocale()],
                    'logo' => $device->menu_logo
                 ])
            @endforeach
        </div>
    </div>
    @if (count($data['chapter']->videos))
        <div class="row black">
            <div class="container">
                <h1>{{ trans('content.all_about_endospheres_therapy') }}</h1>
                @foreach($data['chapter']->videos as $video)
                    @include('_video_block',['video' => $video])
                @endforeach
            </div>
        </div>
    @endif
    <div class="row">
        <div class="container">
            {!! $data['chapter']['content_'.App::getLocale()] !!}
        </div>
    </div>
@endsection