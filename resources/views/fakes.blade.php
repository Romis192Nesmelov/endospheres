@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1>{{ trans('content.warning_fakes') }}</h1>
            @include('_sheet_content_block', ['data' => $data['chapter']->sheets])
        </div>
    </div>
@endsection