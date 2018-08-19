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
                <div class="shadow-container">{!! $data['sub_chapter']['content_'.App::getLocale()] !!}</div>
            </div>
        </div>
    </div>
@endsection