@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <table class="table table-striped table-items">
                <tr>
                    <th class="id">Id</th>
                    <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                    <th class="text-center">{{ trans('admin_content.content') }}</th>
                    <th class="text-center">{{ trans('admin_content.status') }}</th>
                </tr>
                @foreach ($data['chapters'] as $chapter)
                    <tr role="row">
                        <td class="id">{{ $chapter->id }}</td>
                        <td class="text-center"><a href="/admin/chapters/{{ $chapter->slug }}">{{ $chapter['head_'.App::getLocale()] }}</a></td>
                        <td class="text-left">@include('admin._substr_block', ['string' => strip_tags($chapter['content_'.App::getLocale()]), 'length' => 500])</td>
                        <td class="text-center">@include('admin._active_status_block', ['item' => $chapter])</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection