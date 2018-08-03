@extends('layouts.admin')

@section('content')

@include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-image', 'head' => trans('content.do_you_really_want_to_delete_this_image')])
<div class="row">
    <form class="form-horizontal" action="{{ url('/admin/chapter') }}" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4 class="panel-title">{{ trans('content.main_image') }}</h4>
                <div class="edit-image-preview">
                    <div class="main-image">
                        @if (count($data))
                            <img src="/images/slides/slide{{ $data->id }}/1920x1080.jpg" />
                        @endif
                    </div>
                    @include('admin._input_file_block', ['label' => trans('content.change'), 'name' => 'main_image'])
                </div>
            </div>
        </div>

        <div class="panel panel-flat">
            <div class="panel-body">
                @if (count($data))
                    <input type="hidden" name="id" value="{{ $data->id }}">
                @endif

                @include('_input_block', ['label' => trans('content.head').trans('content.in_russian'), 'name' => 'head_ru', 'type' => 'text', 'placeholder' => trans('content.head'), 'value' => (count($data) ? $data->head_ru : '')])
                @include('_input_block', ['label' => trans('content.head').trans('content.in_english'), 'name' => 'head_en', 'type' => 'text', 'placeholder' => trans('content.head'), 'value' => (count($data) ? $data->head_en : '')])

                @include('_textarea_block', ['label' => trans('content.intro').trans('content.in_russian'), 'name' => 'intro_ru', 'value' => (count($data) ? $data->intro_ru : '')])
                @include('_textarea_block', ['label' => trans('content.intro').trans('content.in_english'), 'name' => 'intro_en', 'value' => (count($data) ? $data->intro_en : '')])

                @include('_textarea_block', ['label' => trans('content.content').trans('content.in_russian'), 'name' => 'content_ru', 'value' => (count($data) ? $data->content_ru : '')])
                @include('_textarea_block', ['label' => trans('content.content').trans('content.in_english'), 'name' => 'content_en', 'value' => (count($data) ? $data->content_en : '')])

                @include('admin._checkbox_block',['name' => 'active', 'checked' => (count($data) ? $data->active : true), 'label' => trans('content.active_chapter')])
            </div>
        </div>

        <div class="panel panel-flat">
            <div class="panel-heading">
                <h4 class="panel-title">{{ trans('content.portfolio') }}</h4>
            </div>
            <div class="panel-body">
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="id">Id</th>
                        <th class="image">{{ trans('content.preview') }}</th>
                        <th class="text-center">{{ trans('content.created_at') }}</th>
                        <th class="text-center">{{ trans('content.updated_at') }}</th>
                        <th class="text-center">{{ trans('content.chapter') }}</th>
                        <th class="delete">{{ trans('content.del') }}</th>
                    </tr>
                    @if (count($data) && count($data->images))
                        @foreach ($data->images as $image)
                            <tr role="row" id="{{ $image->id }}">
                                <td class="id">{{ $image->id }}</td>
                                <td class="image"><a class="img-preview" href="/images/portfolio/{{ $image->full }}" data-popup="lightbox"><img src="/images/portfolio/{{ $image->preview }}" /></a></td>
                                <td class="text-center">{{ $image->created_at }}</td>
                                <td class="text-center">{{ $image->updated_at }}</td>
                                <td class="text-center"><b>{{ ucfirst($data['head_'.App::getLocale()]) }}</b></td>
                                <td class="delete"><span del-data="{{ $image->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                            </tr>
                        @endforeach
                    @endif
                    <tr role="row">
                        <td class="id"></td>
                        <td class="image edit-image-preview">
                            <img src="/images/placeholder.jpg" />
                            @include('admin._input_file_block', ['label' => '', 'name' => 'image'])
                        </td>
                        <td class="text-center"><b>{{ trans('content.add_image') }}</b></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="delete"></td>
                    </tr>
                </table>
            </div>
        </div>

        @include('admin._button_block', ['type' => 'submit', 'mainClass' => 'btn-success', 'addClass' => 'pull-right', 'text' => trans('content.save')])
    </form>
</div>

@endsection