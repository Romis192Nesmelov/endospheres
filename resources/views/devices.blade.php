@extends('layouts.main')

@section('content')
    @include('layouts._feedback_modal_block')

    <div class="row">
        <div class="container">
            <h1 class="col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-0">{{ $data['chapter']['head_'.App::getLocale()] }}</h1>
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
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div id="slider-chapter" class="hidden-xs"><img src="{{ asset('images/chapters_slides/'.(isset($data['device']) ? $data['device']->slide : $data['chapter']->devices[0]->slide)) }}" /></div>
                <p class="license hidden-xs">{{ trans('content.license') }}</p>
                <div class="shadow-container">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="logo-container">
                            @if ((isset($data['device']) && $data['device']->is_new) || (!isset($data['device']) && $data['chapter']->devices[0]->is_new))
                                <div class="new-label"></div>
                                <img src="{{ asset('images/eva_logo.png') }}" />
                            @endif
                        </div>
                        <h3>{{ isset($data['device']) ? $data['device']->name : $data['chapter']->devices[0]->name }}</h3>
                        <div class="device-description">{{ isset($data['device']) ? $data['device']['description_'.App::getLocale()] : $data['chapter']->devices[0]['description_'.App::getLocale()] }}</div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                        <img src="{{ asset('images/devices/'.(isset($data['device']) ? $data['device']->image : $data['chapter']->devices[0]->image)) }}" />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p class="blue">{{ trans('content.the_technology_is_patented') }}</p>
                        <p class="blue">{{ trans('content.the_device_is_certified') }}</p>
                        <p><a href="#">{{ trans('content.link_to_the_manufacturer') }}</a></p>
                        <p><a href="#">{{ trans('content.view_catalog') }}</a></p>
                        <p><a href="#">{{ trans('content.view_booklet') }}</a></p>
                        <div class="made-in-italy"><img src="{{ asset('images/italy_flag.gif') }}"/>100% Made in Italy</div>
                        {!! (isset($data['device']) ? $data['device']['content_'.App::getLocale()] : $data['chapter']->devices[0]['content_'.App::getLocale()]) !!}

                        @include('admin._button_block', [
                            'type' => 'button',
                            'text' => trans('content.order_the_commercial_offer'),
                            'mainClass' => 'bg-primary-400',
                            'addAttr' => ['id' => 'order_offer']
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection