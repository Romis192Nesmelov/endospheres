@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-user-file', 'head' => trans('admin_content.do_you_really_want_to_delete_this_file')])
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('admin_menu.user_files') }}</h4>
        </div>

        <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/user-file') }}" method="post">
            {{ csrf_field() }}
            <div class="panel-body">
                @include('admin._input_file_block', ['label' => trans('admin_content.file_simple'), 'name' => 'file'])
                @include('_button_block', ['type' => 'submit', 'icon' => 'icon-database-add', 'text' => trans('admin_content.add_file'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </div>
        </form>
        <div class="panel-body">
            @if (!count($data['files']))
                <h1 class="text-center">{{ trans('admin_content.no_files') }}</h1>
            @else
                <table class="table table-striped table-items">
                    <tr>
                        <th class="id">№</th>
                        <th class="image text-center">{{ trans('admin_content.name') }}</th>
                        <th class="text-center">{{ trans('admin_content.url_short') }}</th>
                        <th class="text-center">{{ trans('admin_content.url_full') }}</th>
                        <th class="delete">{{ trans('admin_content.del') }}</th>
                    </tr>
                    @foreach ($data['files'] as $k => $file)
                        <tr role="row" id="{{ 'file_'.($k+1) }}">
                            <td class="id">{{ ($k+1) }}</td>
                            <td class="text-center"><b>{{ pathinfo($file)['basename'] }}</b></td>
                            <td class="text-center">{{ str_replace(base_path('/public'), '', $file) }}</td>
                            <td class="text-center">{{ $_SERVER['SERVER_NAME'].str_replace(base_path('/public'), '', $file) }}</td>
                            <td class="delete"><span del-data="{{ ($k+1) }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection