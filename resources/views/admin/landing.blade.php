@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-slide', 'head' => trans('admin_content.do_you_really_want_to_delete_this_slide')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/landing') }}" method="post">
                {{ csrf_field() }}
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('admin._meta_tags_block',['chapter' => Settings::getLandingTags()])
                </div>

                <table class="table table-striped table-items">
                    <tr>
                        <th class="id">Id</th>
                        <th class="image text-center">{{ trans('admin_content.slide_simple') }}</th>
                        <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                        <th class="text-center">{{ trans('admin_content.content') }}</th>
                        <th class="text-center">{{ trans('admin_content.status') }}</th>
                        <th class="delete">{{ trans('admin_content.del') }}</th>
                    </tr>
                    @foreach ($data['slides'] as $slide)
                        <tr role="row" id="{{ 'slide_'.$slide->id }}">
                            <td class="id">{{ $slide->id }}</td>
                            <td class="image">
                                @if ($slide->is_image)
                                    <a href="{{ asset($slide->path) }}" data-popup="lightbox"><img src="{{ asset($slide->path).'?dummy='.md5(rand(0,10000)) }}" /></a>
                                @else
                                    <img src="{{ asset('images/video.jpg') }}" />
                                @endif
                            </td>
                            <td class="text-center">{{ $slide['head_'.App::getLocale()] }}</td>
                            <td class="text-left"><a href="/admin/landing/?id={{ $slide->id }}">{!! $slide['description_'.App::getLocale()] !!}</a></td>
                            <td class="text-center">@include('admin._active_status_block', ['item' => $slide])</td>
                            <td class="delete">
                                @if ($slide->is_image)
                                    <span del-data="{{ $slide->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right', 'addAttr' => ['style' => 'margin-left:20px']])
            </form>
            @include('admin._add_button_block',['href' => 'landing/add', 'text' => trans('admin_content.add_slide')])
        </div>
    </div>
@endsection