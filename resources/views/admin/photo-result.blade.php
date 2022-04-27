@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['result']) ? $data['result']['head_'.App::getLocale()] : trans('admin_content.add_photo_result') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/photo-result" method="post">
                {{ csrf_field() }}
                @if (isset($data['result']))
                    <input type="hidden" name="id" value="{{ $data['result']->id }}">
                @endif

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'result', 'height' => 210, 'name' => 'path'])
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => isset($data['result']) ? $data['result']->head_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.description'),
                                'name' => 'description_ru',
                                'value' => isset($data['result']) ? $data['result']->description_ru : '',
                                'simple' => false
                            ])
                        </div>
                    </div>
                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection