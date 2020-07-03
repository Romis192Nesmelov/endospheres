@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['review']) ? $data['review']['name_'.App::getLocale()] : trans('admin_content.add_review') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/review" method="post">
                {{ csrf_field() }}
                @if (isset($data['review']))
                    <input type="hidden" name="id" value="{{ $data['review']->id }}">
                @endif
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.name_a_man'),
                                'name' => 'name_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.name_a_man'),
                                'value' => isset($data['review']) ? $data['review']->name_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.review'),
                                'name' => 'review_ru',
                                'value' => isset($data['review']) ? $data['review']->review_ru : '',
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