@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{!! isset($data['file']) ? trans('admin_content.file', ['name' => $data['name']]) : trans('admin_content.add_file') !!}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/file" method="post">
                {{ csrf_field() }}
                @if (isset($data['file']))
                    <input type="hidden" name="id" value="{{ $data['file']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @if ($data['type'] == 'image')
                                @include('admin._image_block', ['item' => 'path', 'path' => $data['file']->path, 'name' => 'file'])
                            @else
                                @include('admin._input_file_block', ['label' => trans('admin_content.file_simple'), 'name' => 'path'])
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => isset($data['file']) ? $data['file']->head_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'description_ru',
                                'value' => isset($data['file']) ? $data['file']->description_ru : '',
                                'simple' => true
                            ])
                        </div>
                    </div>
                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection