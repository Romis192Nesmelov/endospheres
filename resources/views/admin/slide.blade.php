@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['slide']) ? trans('admin_content.slide', ['number' => $data['slide']->id]) : trans('admin_content.add_slide') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/landing') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['slide']))
                    <input type="hidden" name="id" value="{{ $data['slide']->id }}">
                @endif

                <div class="col-md-{{ $data['slide']->is_image ? '12' : '6' }} col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="panel-title">{{ trans('admin_content.slide_simple') }}</div>
                        </div>
                        <div class="panel-body edit-image-preview">
                            @if (isset($data['slide']))
                                @if ($data['slide']->is_image)
                                    <a href="{{ $data['slide']->path }}" class="img-preview" data-popup="lightbox"><img src="{{ $data['slide']->path }}" /></a>
                                @else
                                    <video width="100%" controls="controls" muted="muted" preload="auto" loop="loop" preload="auto" {{ $data['slide']->poster ? 'poster='.$data['slide']->poster : '' }}>
                                        <source src="{{ $data['slide']->path }}" type="video/mp4">
                                    </video>
                                @endif
                                @include('admin._input_file_block', ['label' => '', 'name' => 'video'])
                            @else
                                <img src="/images/placeholder.jpg" />
                                @include('admin._input_file_block', ['label' => '', 'name' => 'image'])
                            @endif
                        </div>
                    </div>
                </div>

                @if (!$data['slide']->is_image)
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <div class="panel-title">{{ trans('admin_content.poster') }}</div>
                            </div>
                            <div class="panel-body edit-image-preview">
                                @if ($data['slide']->poster)
                                    <a href="{{ $data['slide']->poster }}" class="img-preview" data-popup="lightbox"><img src="{{ $data['slide']->poster }}" /></a>
                                @else
                                    <img src="/images/placeholder.jpg" />
                                @endif
                                @include('admin._input_file_block', ['label' => '', 'name' => 'poster'])
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @if ($data['slide']->is_image)
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
                        @include('admin._checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['slide']) ? $data['slide']->active : 1])
                    </div>


                </div>

                @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection