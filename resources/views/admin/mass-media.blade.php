@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['media']) ? $data['media']['description_'.App::getLocale()] : trans('admin_content.add_mass_media') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/mass-media" method="post">
                {{ csrf_field() }}
                @if (isset($data['media']))
                    <input type="hidden" name="id" value="{{ $data['media']->id }}">
                @endif

                <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'media', 'height' => 255, 'name' => 'preview'])
                        <div class="panel-heading">
                            <h5 class="panel-title">{{ trans('admin_content.choice_pdf_or_jpg') }}</h5>
                            @include('admin._input_file_block', ['label' => '', 'name' => 'full'])
                        </div>
                    </div>
                </div>

                <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('_select_block', [
                                'label' => trans('admin_content.year'),
                                'name' => 'year',
                                'values' => $data['years'],
                                'selected' => isset($data['media']) ? $data['media']->year : date('Y')
                            ])

                            @include('admin._input_block', [
                                'label' => trans('admin_content.description'),
                                'name' => 'description_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.description'),
                                'value' => isset($data['media']) ? $data['media']->description_ru : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection