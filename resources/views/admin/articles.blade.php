@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-sheet-modal', 'function' => 'delete-article', 'head' => trans('admin_content.do_you_really_want_to_delete_this_article')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ trans('admin_menu.articles') }}</h4>
            @include('admin._add_button_block',['href' => 'articles/add', 'text' => trans('admin_content.add_articles')])
        </div>
        <div class="panel-body">
            @include('admin._sheets_table_block',['data' => $data['content'], 'suffix' => 'articles'])
        </div>
    </div>
@endsection