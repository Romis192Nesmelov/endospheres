@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="container">
            @include('_href_image_block', ['href' => '#', 'width' => '18.3%', 'image' => asset('images/endospheres_for_face.jpg'), 'description' => trans('content.endosphere').' '.trans('content.for_face')])
            @include('_href_image_block', ['href' => '#', 'width' => '40.5%', 'image' => asset('images/endospheres_for_body.jpg'), 'description' => trans('content.endosphere').' '.trans('content.for_body')])
            @include('_href_image_block', ['href' => '#', 'width' => '40.5%', 'image' => asset('images/endospheres_for_body_and_face.jpg'), 'description' => trans('content.endosphere').' '.trans('content.for_body_and_face')])
        </div>
    </div>
@endsection