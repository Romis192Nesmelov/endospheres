@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-news', 'head' => trans('admin_content.do_you_really_want_to_delete_this_news')])
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['news']) ? $data['news']['head_'.App::getLocale()] : trans('admin_content.add_heading_news') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/news') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['news']))
                    <input type="hidden" name="id" value="{{ $data['news']->id }}">
                @endif

                @include('admin._meta_tags_block',['chapter' => isset($data['news']) ? $data['news'] : null])

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'news', 'folder' => 'chapters_slides', 'height' => 169, 'name' => 'slide'])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('_select_block', [
                                'label' => trans('admin_content.heading_news'),
                                'name' => 'news_heading_id',
                                'values' => $data['news_heading'],
                                'head' => 'head_'.App::getLocale(),
                                'selected' => isset($data['news']) ? $data['news']->news_heading_id : 1
                            ])

                            @include('admin._date_block', [
                                'label' => trans('admin_content.date'),
                                'name' => 'time',
                                'value' => isset($data['news']) ? $data['news']->time : time()
                            ])

                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => isset($data['news']) ? $data['news']->head_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.description'),
                                'name' => 'description_ru',
                                'value' => isset($data['news']) ? $data['news']->description_ru : '',
                                'simple' => false
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.content'),
                                'name' => 'content_ru',
                                'value' => isset($data['news']) ? $data['news']->content_ru : '',
                                'simple' => false
                            ])
                        </div>

                        @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => isset($data['news']) ? $data['news']->active : 1])
                    </div>
                    @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
                </div>
            </form>
        </div>
    </div>
@endsection