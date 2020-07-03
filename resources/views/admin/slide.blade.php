@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['slide']) ? trans('admin_content.slide', ['number' => $data['slide']->id]) : trans('admin_content.add_slide') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/landing/add') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['slide']))
                    <input type="hidden" name="id" value="{{ $data['slide']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="panel-title">{{ trans('admin_content.slide_simple') }}</div>
                        </div>
                        <div class="panel-body edit-image-preview">
                            @if (isset($data['slide']))
                                @if ($data['slide']->is_image)
                                    <a href="{{ asset($data['slide']->path) }}" class="img-preview" data-popup="lightbox"><img src="{{ asset($data['slide']->path).'?dummy='.md5(rand(0,10000)) }}" /></a>
                                    @include('admin._input_file_block', ['label' => '', 'name' => 'image'])
                                @else
                                    <video width="100%" controls="controls" muted="muted" preload="auto" loop="loop" preload="auto" {{ $data['slide']->poster ? 'poster='.asset($data['slide']->poster) : '' }}>
                                        <source src="{{ asset($data['slide']->path) }}" type="video/mp4">
                                    </video>
{{--                                    @include('admin._input_file_block', ['label' => '', 'name' => 'video'])--}}
                                @endif
                            @else
                                <img height="900" src="{{ asset('images/placeholder.jpg') }}" />
                                @include('admin._input_file_block', ['label' => '', 'name' => 'image'])
                            @endif
                        </div>
                    </div>
                </div>

                {{--@if ((isset($data['slide']) && !$data['slide']->is_image))--}}
                    {{--<div class="col-md-6 col-sm-12 col-xs-12">--}}
                        {{--<div class="panel panel-flat">--}}
                            {{--<div class="panel-heading">--}}
                                {{--<div class="panel-title">{{ trans('admin_content.poster') }}</div>--}}
                            {{--</div>--}}
                            {{--<div class="panel-body edit-image-preview">--}}
                                {{--<a href="{{ asset($data['slide']->poster) }}" class="img-preview" data-popup="lightbox"><img src="{{ asset($data['slide']->poster) }}" /></a>--}}
                                {{--@include('admin._input_file_block', ['label' => '', 'name' => 'poster'])--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @if ((isset($data['slide']) && $data['slide']->is_image) || !isset($data['slide']))
                                @include('admin._input_block', [
                                    'label' => trans('admin_content.head'),
                                    'name' => 'head_ru',
                                    'type' => 'text',
                                    'placeholder' => trans('admin_content.head'),
                                    'value' => isset($data['slide']) ? $data['slide']->head_ru : ''
                                ])
                            @endif

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'description_ru',
                                'value' => isset($data['slide']) ? $data['slide']->description_ru : '',
                                'simple' => true
                            ])

                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="color-palette">
                            @include('admin._color_picker_block', [
                                'label' => trans('admin_content.background_color'),
                                'name' => 'background_color',
                                'value' => isset($data['slide']) ? $data['slide']->background_color : 'rgb(255,255,255)'
                            ])
                        </div>

                        <div class="color-palette">
                            @include('admin._color_picker_block', [
                                'label' => trans('admin_content.mouse_color'),
                                'name' => 'mouse_color',
                                'value' => isset($data['slide']) ? $data['slide']->mouse_color : 'rgb(255,255,255)'
                            ])
                        </div>
                    </div>


                        <div class="panel panel-flat">
                            @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['slide']) ? $data['slide']->active : 1])
                        </div>

                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection