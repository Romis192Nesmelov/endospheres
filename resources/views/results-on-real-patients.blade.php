@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => trans('content.real_results')])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @include('layouts._secondary_menu_block',['items' => $data['chapter']->subChapters, 'prefix' => $data['chapter']->slug, 'activeId' => $data['sub_chapter']->id])
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['sub_chapter']->slide, 'title' => $data['sub_chapter']['slide_title_'.App::getLocale()], 'showLicense' => false])
                <div class="quote gray">
                    {{ $data['sub_chapter']['subscribe_'.App::getLocale()] }}
                </div>
                @if (count($data['sub_chapter']->reviews))
                    @include('_hrefs_block',[
                        'items' => $data['sub_chapter']->reviews,
                        'head' => 'name_'.App::getLocale(),
                        'content' => 'review_'.App::getLocale(),
                        'label' => trans('content.review'),
                        'labelType' => 'static'
                    ])
                @elseif (count($data['sub_chapter']->results))
                    @foreach($data['sub_chapter']->results as $result)
                        <div class="photo-result">
                            <a href="{{ asset($result->path) }}" data-head="{{ $result['head_'.App::getLocale()] }}" data-description="{{ $result['description_'.App::getLocale()] }}" data-popup="lightbox"><img src="{{ asset($result->path) }}" /></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection