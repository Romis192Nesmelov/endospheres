@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ $data['chapter']['head_'.App::getLocale()] }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/chapter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $data['chapter']->id }}">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => $data['chapter']->head_ru
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content_ru',
                                'value' => $data['chapter']->content_ru,
                                'simple' => false
                            ])
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h4 class="panel-title">{{ trans('admin_content.chapter_video') }}</h4>
                        </div>
                        @if (count($data['chapter']->videos))
                            <div class="panel-body">
                                @foreach($data['chapter']->videos as $video)
                                    @include('admin._video_input_block', ['video' => $video])
                                @endforeach
                            </div>
                        @endif
                            <div class="panel-body">
                                @for($i=0;$i<10;$i++)
                                    @include('admin._video_input_block', ['video' => '', 'addClass' => 'new-video'])
                                @endfor

                                @include('admin._button_block', [
                                    'addAttr' => ['id' => 'addVideo'],
                                    'type' => 'button',
                                    'icon' => 'icon-database-add',
                                    'text' => trans('admin_content.add_video'),
                                    'mainClass' => 'bg-primary-400',
                                    'addClass' => 'pull-right'
                                ])
                            </div>
                        </div>


                    <div class="panel panel-flat">
                        @include('admin._checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => $data['chapter']->active])
                    </div>

                </div>
                @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection