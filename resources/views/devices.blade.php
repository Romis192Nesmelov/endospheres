@extends('layouts.main')

@section('content')
    @include('layouts._feedback_modal_block')
    <div class="row main">
        <div class="container">
            @include('_head_block', ['head' => $data['chapter']['head_'.App::getLocale()]])
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                @foreach($data['chapter']->devices as $k => $device)
                    @if ($device->active)
                        <a href="/devices/{{ $device->slug }}">
                            <div class="secondary-menu {{ (isset($data['device']) && $data['device']->id == $device->id) || (!isset($data['device']) && !$k) ? 'active' : '' }}">
                                <img src="{{ asset('images/'.$device->menu_logo) }}" />
                                <div class="table"><span>{{ trans('content.endosphere') }}</span> {{ $device['head_'.App::getLocale()] }}</div>
                            </div>
                        </a>
                    @endif
                @endforeach
                @include('layouts._nav_left_block', ['items' => $mainMenu])
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                @include('_chapter_slider_block',['slide' => (isset($data['device']) ? $data['device']->slide : $data['chapter']->devices[0]->slide), 'showLicense' => true])

                <div class="shadow-container">
                    <div class="col-lg-4 col-md-4 col-sm-9 col-xs-12">
                        <div class="logo-container">
                            @if ((isset($data['device']) && $data['device']->is_new) || (!isset($data['device']) && $data['chapter']->devices[0]->is_new))
                                <div class="new-label"></div>
                                <img src="{{ asset('images/eva_logo.png') }}" />
                            @endif
                        </div>
                        <div class="device-description"><span>{{ isset($data['device']) ? $data['device']->name : $data['chapter']->devices[0]->name }}</span> {{ isset($data['device']) ? $data['device']['description_'.App::getLocale()] : $data['chapter']->devices[0]['description_'.App::getLocale()] }}</div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-3 col-xs-12 device-img text-center">
                        <img src="{{ asset('images/devices/'.(isset($data['device']) ? $data['device']->image : $data['chapter']->devices[0]->image)) }}" />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 device-right-block">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            <p class="blue">{{ trans('content.the_technology_is_patented') }}</p>
                            <p class="blue">{{ trans('content.the_device_is_certified') }}</p>
                            <p><a href="http://www.fenixgroup.it/system/" target="_blank">{{ trans('content.link_to_the_manufacturer') }}</a></p>
                            <p><a href="{{ asset('pdfs/katalog_eva_423x297_web.pdf') }}" target="_blank">{{ trans('content.view_catalog') }}</a></p>
                            <p><a href="{{ asset('pdfs/eva_buklet_445x150mm_web.pdf') }}" target="_blank">{{ trans('content.view_booklet') }}</a></p>
                            <div class="made-in-italy"><img src="{{ asset('images/italy_flag.gif') }}"/>100% Made in Italy</div>
                            @include('_button_block', ['type' => 'button', 'text' => trans('content.order_the_commercial_offer'), 'mainClass' => 'bg-primary-400', 'addClass' => 'order_offer visible-sm hidden-xs'])
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                            {!! (isset($data['device']) ? $data['device']['content_'.App::getLocale()] : $data['chapter']->devices[0]['content_'.App::getLocale()]) !!}
                        </div>
                        @include('_button_block', ['type' => 'button', 'text' => trans('content.order_the_commercial_offer'), 'mainClass' => 'bg-primary-400', 'addClass' => 'order_offer visible-lg visible-md hidden-sm visible-xs'])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection