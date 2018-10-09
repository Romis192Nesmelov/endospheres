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
                <div class="quote gray">
                    {{ $data['chapter']['subscribe_'.App::getLocale()] }}
                </div>
                @if (count($data['chapter']->questions))
                    @include('_hrefs_block',[
                        'items' => $data['chapter']->questions,
                        'head' => 'question_'.App::getLocale(),
                        'content' => 'answer_'.App::getLocale(),
                        'label' => trans('content.answer'),
                        'labelType' => 'static'
                    ])
                @endif
            </div>
        </div>
    </div>
@endsection