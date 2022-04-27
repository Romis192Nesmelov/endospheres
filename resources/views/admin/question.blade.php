@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['question']) ? $data['question']['question_'.App::getLocale()] : trans('admin_content.add_question') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/question" method="post">
                {{ csrf_field() }}
                @if (isset($data['question']))
                    <input type="hidden" name="id" value="{{ $data['question']->id }}">
                @endif
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.question'),
                                'name' => 'question_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.question'),
                                'value' => isset($data['question']) ? $data['question']->question_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.answer'),
                                'name' => 'answer_ru',
                                'value' => isset($data['question']) ? $data['question']->answer_ru : '',
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