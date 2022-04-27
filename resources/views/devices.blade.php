@extends('layouts.main')

@section('content')
    {{ csrf_field() }}
    @include('layouts._feedback_modal_block')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => $data['chapter']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @foreach($data['chapter']->devices as $k => $device)
                    @if ($device->active)
                        <a href="/devices/{{ $device->slug }}">
                            <div class="secondary-menu {{ $data['device']->id == $device->id ? 'active' : '' }}">
                                <img src="{{ asset('images/'.$device->menu_logo) }}" />
                                <div class="table"><span>{{ trans('content.endosphere') }}</span> {{ $device['head_'.App::getLocale()] }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => $data['device']->slide, 'title' => $data['device']['slide_title_'.App::getLocale()], 'showLicense' => $data['device']->id != 1])

                <div class="shadow-container">
                    <div class="col-lg-4 col-md-4 col-sm-9 col-xs-12">
                        <div class="logo-container">
                            @if ($data['device']->is_new)
                                <div class="new-label"></div>
                                <img title="EVA" src="{{ asset('images/eva_logo.png') }}" />
                            @endif
                        </div>
                        <div class="device-description"><span>{{ $data['device']->name }}</span> {{ $data['device']['description_'.App::getLocale()] }}</div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 device-img text-center">
                        <img {!! $data['device']['image_title_'.App::getLocale()] ? 'title="'.$data['device']['image_title_'.App::getLocale()].'"' : '' !!} src="{{ asset('images/devices/'.$data['device']->image) }}" />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 device-right-block">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <p class="blue">{{ trans('content.the_technology_is_patented') }}</p>
                            @if ($data['device']->id != 1)
                                <p class="blue">{{ trans('content.the_device_is_certified') }}</p>
                            @endif
                            <p><a href="http://www.fenixgroup.it/system/" target="_blank">{{ trans('content.link_to_the_manufacturer') }}</a></p>

                            @if ($data['device']->catalogue)
                                <p><a href="{{ asset($data['device']->catalogue) }}" target="_blank">{{ trans('content.view_catalog') }}</a></p>
                            @endif

                            @if ($data['device']->booklet)
                                <p><a href="{{ asset($data['device']->booklet) }}" target="_blank">{{ trans('content.view_booklet') }}</a></p>
                            @endif

                            <div class="made-in-italy"><img src="{{ asset('images/italy_flag.gif') }}"/>100% Made in Italy</div>
                            @if ($data['device']->id != 1)
                                @include('_button_block', ['type' => 'button', 'text' => trans('content.order_the_commercial_offer'), 'mainClass' => 'bg-primary-400', 'addClass' => 'order_offer visible-sm hidden-xs'])
                            @endif
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            {!! $data['device']['content_'.App::getLocale()] !!}
                        </div>
                        @if ($data['device']->id != 1)
                            @include('_button_block', ['type' => 'button', 'text' => trans('content.order_the_commercial_offer'), 'mainClass' => 'bg-primary-400', 'addClass' => 'order_offer visible-lg visible-md hidden-sm visible-xs'])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection