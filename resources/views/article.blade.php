@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1>{{ $data['article']->head }}</h1>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <ul class="navigation navigation-main navigation-accordion sheet-menu hidden-xs">
                    @foreach ($articles as $article)
                        <li class="{{ ( preg_match('/^(articles\/'.$article->slug.')/',Request::path()) ) ? 'active ' : ''}}">
                            <a href="/articles/{{ $article->slug }}">{{ $article->head }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                {!! $data['article']->content !!}
            </div>
        </div>
    </div>

    <div id="on_top_button"><i class="glyphicon glyphicon-upload"></i></div>
@endsection