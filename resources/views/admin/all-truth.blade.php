@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-truth', 'head' => trans('admin_content.do_you_really_want_to_delete_this_truth')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('admin_menu.all_truth') }}</h4>
            @include('admin._add_button_block',['href' => 'all-truth/add', 'text' => trans('admin_content.add_truth')])
        </div>
        <div class="panel-body">
            @if (count($data['all_truth']))
                <table class="table table-striped table-items">
                    <tr>
                        <th class="id">Id</th>
                        <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                        <th class="text-center">{{ trans('admin_content.content') }}</th>
                        <th class="text-center">{{ trans('admin_content.status') }}</th>
                        <th class="delete">{{ trans('admin_content.del') }}</th>
                    </tr>
                    @foreach ($data['all_truth'] as $truth)
                        <tr role="row" id="{{ 'truth_'.$truth->id }}">
                            <td class="id">{{ $truth->id }}</td>
                            <td class="text-center"><a href="/admin/all-truth/?id={{ $truth->id }}">{{ $truth->head }}</a></td>
                            <td class="text-left">{!! str_limit($truth->content, 500) !!}</td>
                            <td class="text-center">@include('admin._active_status_block', ['item' => $truth])</td>
                            <td class="delete"><span del-data="{{ $truth->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endforeach
                </table>
                @include('admin._add_button_block',['href' => 'all-truth/add', 'text' => trans('admin_content.add_truth')])
            @endif
        </div>
    </div>
@endsection