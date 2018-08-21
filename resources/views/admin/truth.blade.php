@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['truth']) ? $data['truth']->head : trans('admin_content.add_truth') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/truth" method="post">
                {{ csrf_field() }}
                @if (isset($data['truth']))
                    <input type="hidden" name="id" value="{{ $data['truth']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => isset($data['truth']) ? $data['truth']->head : ''
                            ])

                            @include('admin._date_block', [
                                'label' => trans('admin_content.date'),
                                'name' => 'time',
                                'value' => isset($data['truth']) ? $data['truth']->time : time()
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content',
                                'value' => isset($data['truth']) ? $data['truth']->content : '',
                                'simple' => false
                            ])
                        </div>
                    </div>

                    @include('admin._checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['truth']) ? $data['truth']->active : 1])
                </div>
                @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection