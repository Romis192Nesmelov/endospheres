@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-slider', 'head' => trans('admin_content.do_you_really_want_to_delete_this_slide')])
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="/admin/add-slide" method="post">
                {{ csrf_field() }}
                <table class="table table-striped table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin_content.slide_simple') }}</th>
                        <th width="20" class="text-center delete">{{ trans('admin_content.del') }}</th>
                    </tr>
                    @foreach ($data['slider'] as $slide)
                        <tr role="row" id="{{ 'slider_'.str_replace('slide','',pathinfo($slide)['filename']) }}">
                            <td class="slide text-center"><img src="{{ asset('images/slider/'.$slide) }}" /></td>
                            <td class="delete text-center"><span del-data="{{ str_replace('slide','',pathinfo($slide)['filename']) }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endforeach
                    <tr role="row">
                        <td class="slide text-center edit-image-preview">
                            <img height="300" src="{{ asset('images/placeholder.jpg') }}" />
                            @include('admin._input_file_block', ['name' => 'file'])
                        </td>
                        <td></td>
                    </tr>
                </table>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection