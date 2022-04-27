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
                @if (isset($data['news']) && count($data['news']))
                    <div class="quote gray">{{ $data['news'][0]->heading['subscribe_'.App::getLocale()] }}</div>
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
                @elseif (isset($data['magic']))
                    <div class="quote gray">{{ $data['heading']['subscribe_'.App::getLocale()] }}</div>
                    <?php $count = 1; ?>
                    @foreach ($data['magic'] as $k => $magic)
                        @if ($count == 1)
                            <div class="magic-pair">
                        @endif
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 magic-block">
                            <div class="image">
                                <a href="{{ url(Request::path().'/'.$magic->slug) }}"><img src="{{ asset('images/magics/'.$magic->image) }}" /></a>
                            </div>
                            <h3>{{ $magic['head_'.App::getLocale()] }}</h3>
                            <p>@include('_cropped_content_block',['croppingContent' => $magic['content_'.App::getLocale()], 'length' => 110])</p>
                        </div>
                        @if ($count == 2 || $k == count($data['magic'])-1)
                            <?php $count = 0; ?>
                            </div>
                        @endif
                        <?php $count++; ?>
                    @endforeach
                    {{ $data['magic']->render() }}
                @elseif (isset($data['current_magic']))
                    <h2>{{ $data['current_magic']['head_'.App::getLocale()] }}</h2>
                    {!! $data['current_magic']['content_'.App::getLocale()] !!}
                    @include('_back_block')
                @endif
            </div>
        </div>
    </div>
@endsection