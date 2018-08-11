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
                        <td class="text-center">{{ $chapter['head_'.App::getLocale()] }}</td>
                        <td class="text-left"><a href="/admin/chapters/{{ $chapter->slug }}">{!! str_limit($chapter['content_'.App::getLocale()], 500) !!}</a></td>
                        <td class="text-center">@include('admin._chapter_status_block')</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection