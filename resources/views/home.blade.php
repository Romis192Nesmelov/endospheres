@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="container">
            @include('_href_image_block', ['href' => '#', 'width' => '18.3%', 'image' => asset('images/endospheres_for_face.jpg'), 'description' => '<span>'.trans('content.endosphere').'</span> '.trans('content.for_face'), 'logo' => 'sroface_logo.png'])
            @include('_href_image_block', ['href' => '#', 'width' => '40.5%', 'image' => asset('images/endospheres_for_body.jpg'), 'description' => '<span>'.trans('content.endosphere').'</span> '.trans('content.for_body'), 'logo' => 'sroface_logo.png'])
            @include('_href_image_block', ['href' => '#', 'width' => '40.5%', 'image' => asset('images/endospheres_for_body_and_face.jpg'), 'description' => '<span>'.trans('content.endosphere').'</span> '.trans('content.for_body_and_face'), 'logo' => 'sroface_logo.png'])
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