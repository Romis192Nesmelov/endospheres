@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['content']) ? $data['content']->head : trans('admin_content.add_'.$data['suffix']) }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/{{ $data['suffix'] }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['content']))
                    <input type="hidden" name="id" value="{{ $data['content']->id }}">
                @endif

                @include('admin._meta_tags_block',['chapter' => isset($data['content']) ? $data['content'] : null])

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => isset($data['content']) ? $data['content']->head : ''
                            ])

                            @if ($data['show_time'])
                                @include('admin._date_block', [
                                    'label' => trans('admin_content.date'),
                                    'name' => 'time',
                                    'value' => isset($data['content']) ? $data['content']->time : time()
                                ])
                            @endif

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content',
                                'value' => isset($data['content']) ? $data['content']->content : '',
                                'simple' => false
                            ])
                        </div>
                    </div>

                    @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['content']) ? $data['content']->active : 1])
                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection