@extends('layouts.admin')

@section('content')

    {{--@include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-news', 'head' => trans('admin_content.delete_news')])--}}
    {{--{{ csrf_field() }}--}}

    <div class="panel panel-flat">
        <div class="panel-heading">
            @include('admin._add_button_block',['href' => 'landing/add', 'text' => trans('admin_content.add_slide')])
        </div>
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="id">Id</th>
                    <th class="image text-center">{{ trans('admin_content.slide_simple') }}</th>
                    <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                    <th class="text-center">{{ trans('admin_content.content') }}</th>
                    <th class="text-center">{{ trans('admin_content.status') }}</th>
                    {{--<th class="delete">{{ trans('admin_content.del') }}</th>--}}
                </tr>
                @foreach ($data['slides'] as $slide)
                    <tr role="row" id="{{ 'slide_'.$slide->id }}">
                        <td class="id">{{ $slide->id }}</td>
                        <td class="image">
                            @if ($slide->is_image)
                                <a href="{{ $slide->path }}" data-popup="lightbox"><img src="{{ $slide->path.'?dummy='.md5(rand(0,10000)) }}" /></a>
                            @else
                                <img src="/images/video.jpg" />
                            @endif
                        </td>
                        <td class="text-center">{{ $slide->head_ru }}</td>
                        <td class="text-left"><a href="/admin/landing/?id={{ $slide->id }}">{!! $slide->description_ru !!}</a></td>
                        <td class="text-center">@include('admin._slide_status_block')</td>
{{--                        <td class="delete"><span del-data="{{ $slide->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>--}}
                    </tr>
                @endforeach
            </table>
            @include('admin._add_button_block',['href' => 'landing/add', 'text' => trans('admin_content.add_slide')])
        </div>
    </div>
@endsection