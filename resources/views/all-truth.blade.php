@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1>{{ trans('content.all_truth_about') }}</h1>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <ul class="navigation navigation-main navigation-accordion truth-menu hidden-xs">
                    @foreach ($data['all_truth'] as $k => $truth)
                        <li class=" {{ !$k ? 'active ' : ''}}">
                            <a href="#{{ $truth->id }}">{{ $truth->head }}</a>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @foreach ($data['all_truth'] as $truth)
                    <a name="{{ $truth->id }}"></a>
                    <div class="publication-date">{{ trans('content.published', ['date' => date('d.m.Y', $truth->time)]) }}</div>
                    <h2>{{ $truth->head }}</h2>
                    <div class="truth-content">{!! $truth->content !!}</div>
                @endforeach
            </div>
        </div>
    </div>
@endsection