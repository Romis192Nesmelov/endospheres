@extends('layouts.main')

@section('content')
    <div class="row main">
        <div class="container">
            <h1>{{ trans('content.all_truth_about') }}</h1>
            @include('_sheet_content_block', ['data' => $data['all_truth']])
        </div>
    </div>
@endsection