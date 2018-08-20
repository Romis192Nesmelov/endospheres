@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-review-modal', 'function' => 'delete-review', 'head' => trans('admin_content.do_you_really_want_to_delete_this_review')])
    @include('admin._modal_delete_block',['modalId' => 'delete-result-modal', 'function' => 'delete-result', 'head' => trans('admin_content.do_you_really_want_to_delete_this_photo')])

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ $data['sub_chapter']['head_'.App::getLocale()] }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/sub-chapter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $data['sub_chapter']->id }}">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'sub_chapter', 'folder' => 'chapters_slides', 'height' => 169, 'name' => 'slide'])
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('admin._input_block', [
                                'label' => trans('admin_content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'placeholder' => trans('admin_content.head'),
                                'value' => $data['sub_chapter']->head_ru
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.subscribe'),
                                'name' => 'subscribe_ru',
                                'value' => $data['sub_chapter']->subscribe_ru,
                                'simple' => true
                            ])

                            @if (count($data['sub_chapter']->reviews))
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">{{ trans('admin_content.sub_chapters_reviews') }}</h4>
                                        @include('admin._add_button_block',['href' => 'review/add', 'text' => trans('admin_content.add_review')])
                                    </div>
                                    <div class="panel-body">
                                        @if (count($data['sub_chapter']->reviews))
                                            <table class="table table-striped table-items">
                                                <tr>
                                                    <th class="id">Id</th>
                                                    <th width="20%" class="text-center">{{ trans('admin_content.name_a_man') }}</th>
                                                    <th class="text-center">{{ trans('admin_content.review') }}</th>
                                                    <th class="delete">{{ trans('admin_content.del') }}</th>
                                                </tr>
                                                @foreach ($data['sub_chapter']->reviews as $review)
                                                    <tr role="row" id="{{ 'review_'.$review->id }}">
                                                        <td class="id">{{ $review->id }}</td>
                                                        <td class="text-left"><a href="/admin/review/?id={{ $review->id }}">{{ $review['name_'.App::getLocale()] }}</a></td>
                                                        <td class="text-left">{{ str_limit(strip_tags($review['review_'.App::getLocale()]), 500) }}</td>
                                                        <td class="delete"><span del-data="{{ $review->id }}" modal-data="delete-review-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            @include('admin._add_button_block',['href' => 'review/add', 'text' => trans('admin_content.add_review')])
                                        @endif
                                    </div>
                                </div>
                            @elseif (count($data['sub_chapter']->results))
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">{{ trans('admin_content.sub_chapters_photo_results') }}</h4>
                                        @include('admin._add_button_block',['href' => 'photo-result/add', 'text' => trans('admin_content.add_photo_result')])
                                    </div>
                                    <div class="panel-body">
                                        <table class="table table-striped table-items">
                                            <tr>
                                                <th class="id">Id</th>
                                                <th class="image text-center">{{ trans('admin_content.photo_simple') }}</th>
                                                <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                                                <th class="text-center">{{ trans('admin_content.description') }}</th>
                                                <th class="delete">{{ trans('admin_content.del') }}</th>
                                            </tr>
                                            @foreach ($data['sub_chapter']->results as $result)
                                                <tr role="row" id="{{ 'photo_'.$result->id }}">
                                                    <td class="id">{{ $result->id }}</td>
                                                    <td class="image"><a href="{{ asset($result->path) }}" data-popup="lightbox"><img src="{{ asset($result->path).'?dummy='.md5(rand(0,10000)) }}" /></a></td>
                                                    <td class="text-center"><a href="/admin/photo-result/?id={{ $result->id }}">{{ $result['head_'.App::getLocale()] }}</a></td>
                                                    <td class="text-center">{{ $result['description_'.App::getLocale()] }}</td>
                                                    <td class="delete"><span del-data="{{ $result->id }}" modal-data="delete-result-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        @include('admin._add_button_block',['href' => 'photo-result/add', 'text' => trans('admin_content.add_photo_result')])
                                    </div>
                                </div>
                            @endif

                            @if (!count($data['sub_chapter']->reviews) && !count($data['sub_chapter']->results))
                                @include('admin._textarea_block', [
                                    'label' => trans('admin_content.content'),
                                    'name' => 'content_ru',
                                    'value' => $data['sub_chapter']->content_ru,
                                    'simple' => false
                                ])
                            @endif
                        </div>
                    </div>
                </div>
                @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection