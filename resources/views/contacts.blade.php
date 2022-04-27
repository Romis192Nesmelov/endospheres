@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="container">
            @include('_head_block', ['head' => $data['chapter']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="shadow-container">{!! $data['chapter']['content_'.App::getLocale()] !!}</div>
            </div>
        </div>
    </div>
@endsection