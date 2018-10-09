@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => $data['heading']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._secondary_menu_block',['items' => $data['headings'], 'prefix' => 'news', 'activeId' => $data['heading']->id])
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => isset($data['current_news']) ? $data['current_news']->slide : $data['heading']->slide, 'title' => isset($data['current_news']) ? $data['current_news']['slide_title_'.App::getLocale()] : $data['heading']['slide_title_'.App::getLocale()], 'showLicense' => false])
                @if (!isset($data['current_news']))
                    <div class="quote gray">
                        {{ $data['news'][0]->heading['subscribe_'.App::getLocale()] }}
                    </div>
                @endif
                @if (isset($data['news']) && count($data['news']))
                    @include('_hrefs_block',[
                        'items' => $data['news'],
                        'head' => 'head_'.App::getLocale(),
                        'content' => 'description_'.App::getLocale(),
                         'label' => 'time',
                         'labelType' => 'date',
                         'prefix' => 'news/'.$data['news'][0]->heading->slug
                     ])
                    {{ $data['news']->render() }}
                @elseif (isset($data['current_news']))
                    <h2 class="head-news">{{ $data['current_news']['head_'.App::getLocale()] }}<div class="label">{{ date('d.m.Y',$data['current_news']->time) }}</div></h2>
                    {!! $data['current_news']['content_'.App::getLocale()] !!}
                @endif
            </div>
        </div>
    </div>
@endsection