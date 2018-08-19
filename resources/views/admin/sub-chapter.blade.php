@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ $data['sub_chapter']['head_'.App::getLocale()] }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/sub-chapter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $data['sub_chapter']->id }}">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'sub_chapter', 'folder' => 'chapters_slides', 'height' => 169, 'name' => 'slide'])
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
                                'value' => $data['sub_chapter']->head_ru
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content_ru',
                                'value' => $data['sub_chapter']->content_ru,
                                'simple' => false
                            ])
                        </div>
                    </div>
                </div>
                @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection