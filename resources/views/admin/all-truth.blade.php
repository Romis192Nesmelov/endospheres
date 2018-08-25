@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-sheet-modal', 'function' => 'delete-truth', 'head' => trans('admin_content.do_you_really_want_to_delete_this_truth')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('admin_menu.all-truth') }}</h4>
            @include('admin._add_button_block',['href' => 'all-truth/add', 'text' => trans('admin_content.add_all-truth')])
        </div>
        <div class="panel-body">
            @include('admin._sheets_table_block',['data' => $data['content'], 'suffix' => 'all-truth'])
        </div>
    </div>
@endsection