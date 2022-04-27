@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['resource']) ? $data['resource']['description_'.App::getLocale()] : trans('admin_content.add_resource') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/resource" method="post">
                {{ csrf_field() }}
                @if (isset($data['resource']))
                    <input type="hidden" name="id" value="{{ $data['resource']->id }}">
                @endif

                @if (Session::get('sub_chapter') != 7)
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="panel panel-flat">
                            @include('admin._image_block', ['item' => 'resource', 'height' => 60, 'name' => 'logo'])
                        </div>
                    </div>
                @endif

                <div class="col-md-{{ Session::get('sub_chapter') != 7 ? '10' : '12' }} col-sm-{{ Session::get('sub_chapter') != 7 ? '10' : '12' }} col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.description'),
                                'name' => 'description_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.description'),
                                'value' => isset($data['resource']) ? $data['resource']->description_ru : ''
                            ])

                            @include('admin._input_block', [
                                'label' => trans('admin_content.url'),
                                'name' => 'url',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.url'),
                                'value' => isset($data['resource']) ? $data['resource']->url : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection