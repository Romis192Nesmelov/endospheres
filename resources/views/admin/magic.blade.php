@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['magic']) ? $data['magic']['head_'.App::getLocale()] : trans('admin_content.add_articles') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/magic') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['magic']))
                    <input type="hidden" name="id" value="{{ $data['magic']->id }}">
                @endif

                @include('admin._meta_tags_block',['chapter' => isset($data['magic']) ? $data['magic'] : null])

                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'magic', 'folder' => 'magics', 'name' => 'image', 'title' => false])
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
                                'value' => isset($data['magic']) ? $data['magic']->head_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content_ru',
                                'value' => isset($data['magic']) ? $data['magic']->content_ru : '',
                                'simple' => false
                            ])
                        </div>

                        @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['magic']) ? $data['magic']->active : 1])
                    </div>
                    @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection