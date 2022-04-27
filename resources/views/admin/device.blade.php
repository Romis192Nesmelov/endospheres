@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-file-modal', 'function' => 'delete-device-booklet', 'head' => trans('admin_content.do_you_really_want_to_delete_this_file')])
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['device']) ? $data['device']->name : trans('admin_content.add_device') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/device') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['device']))
                    <input type="hidden" name="id" value="{{ $data['device']->id }}">
                @endif

                @include('admin._meta_tags_block',['chapter' => isset($data['device']) ? $data['device'] : null])

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'device', 'folder' => '', 'height' => 210, 'name' => 'home_page_image'])
                        @include('admin._image_block', ['item' => 'device', 'folder' => 'devices', 'height' => 810, 'name' => 'image'])
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._image_block', ['mainClass' => 'col-md-12 col-sm-12 col-xs-12', 'item' => 'device', 'folder' => 'chapters_slides', 'height' => 247, 'name' => 'slide'])
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                @include('admin._radio_button_block',[
                                    'addClass' => '',
                                    'name' => 'menu_logo',
                                    'values' => [
                                        ['val' => 'sroface_logo.png', 'descript' => '<div class="device-logo small"><img src="'.asset('images/sroface_logo.png').'" /></div>'],
                                        ['val' => 'ak_sensorbody_logo.png', 'descript' => '<div class="device-logo small"><img src="'.asset('images/ak_sensorbody_logo.png').'" /></div>'],
                                        ['val' => 'ak_sensor_logo.png', 'descript' => '<div class="device-logo small"><img src="'.asset('images/ak_sensor_logo.png').'" /></div>'],
                                    ],
                                    'activeValue' => count($errors) ? old('menu_logo') : (isset($data['device']) ? $data['device']->menu_logo : 'sroface_logo.png')
                                ])
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                @include('admin._input_block', [
                                    'label' => trans('admin_content.name'),
                                    'name' => 'name',
                                    'type' => 'text',
                                    'placeholder' => trans('admin_content.name'),
                                    'value' => isset($data['device']) ? $data['device']->name : ''
                                ])

                                @include('admin._input_block', [
                                    'label' => trans('content.endosphere'),
                                    'name' => 'head_ru',
                                    'type' => 'text',
                                    'placeholder' => trans('admin_content.head'),
                                    'value' => isset($data['device']) ? $data['device']->head_ru : ''
                                ])

                                @include('admin._input_block', [
                                    'label' => trans('admin_content.description'),
                                    'name' => 'description_ru',
                                    'type' => 'text',
                                    'placeholder' => trans('admin_content.description'),
                                    'value' => isset($data['device']) ? $data['device']->description_ru : ''
                                ])
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @include('admin._textarea_block', [
                                    'label' => trans('admin_content.content'),
                                    'name' => 'content_ru',
                                    'value' => isset($data['device']) ? $data['device']->content_ru : '',
                                    'simple' => false
                                ])

                                @include('admin._catalogue_file_table_block', ['fileName' => 'booklet'])
                                @include('admin._catalogue_file_table_block', ['fileName' => 'catalogue'])
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        @include('_checkbox_block', ['name' => 'is_new', 'label' => trans('admin_content.status_new'), 'checked' => (isset($data['device']) ? $data['device']->is_new : 1)])
                        @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => (isset($data['device']) ? $data['device']->active : 1)])
                    </div>

                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection