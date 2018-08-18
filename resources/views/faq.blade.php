@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1 class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-1">{{ $data['chapter']['head_'.App::getLocale()] }}</h1>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['chapter']->slide, 'showLicense' => false])
                <div class="quote gray">
                    {{ $data['chapter']['content_'.App::getLocale()] }}
                </div>
                @if ($data['chapter']->questions)
                    <ul class="hrefs">
                        @foreach($data['chapter']->questions as $question)
                            <li class="blue question" data-question="{{ $question->id }}"><div class="href">{{ $question['question_'.App::getLocale()] }}</div><div class="label"><div>{{ trans('content.answer') }}</div></div></li>
                            <li class="answer" data-answer="{{ $question->id }}">{{ $question['answer_'.App::getLocale()] }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection