@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ $data['sub_chapter']['head_'.App::getLocale()] }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/sub-chapter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $data['sub_chapter']->id }}">

                @include('admin._meta_tags_block',['chapter' => $data['sub_chapter']])

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
                                            @include('admin._modal_delete_block',['modalId' => 'delete-review-modal', 'function' => 'delete-review', 'head' => trans('admin_content.do_you_really_want_to_delete_this_review')])

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
                                                        <td class="text-left">@include('admin._substr_block', ['string' => strip_tags($review['review_'.App::getLocale()]), 'length' => 500])</td>
                                                        <td class="delete"><span del-data="{{ $review->id }}" modal-data="delete-review-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            @include('admin._add_button_block',['href' => 'review/add', 'text' => trans('admin_content.add_review')])
                                        @endif
                                    </div>
                                </div>
                            @elseif (count($data['sub_chapter']->results))
                                @include('admin._modal_delete_block',['modalId' => 'delete-result-modal', 'function' => 'delete-result', 'head' => trans('admin_content.do_you_really_want_to_delete_this_photo')])

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
                            @elseif ($data['sub_chapter']->have_a_mm)
                                @include('admin._modal_delete_block',['modalId' => 'delete-media-modal', 'function' => 'delete-media', 'head' => trans('admin_content.do_you_really_want_to_delete_this_mm')])

                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">{{ trans('admin_content.sub_chapters_mass_media') }}</h4>
                                        @include('admin._add_button_block',['href' => 'mass-media/add', 'text' => trans('admin_content.add_mass_media')])
                                    </div>
                                    @if (count($data['sub_chapter']->massMedia))
                                        <div class="panel-body">
                                            <table class="table table-striped table-items">
                                                <tr>
                                                    <th class="id">Id</th>
                                                    <th class="image text-center">{{ trans('admin_content.cover_simple') }}</th>
                                                    <th class="text-center">{{ trans('admin_content.description') }}</th>
                                                    <th class="text-center">{{ trans('admin_content.year') }}</th>
                                                    <th class="text-center">{{ trans('admin_content.type') }}</th>
                                                    <th class="delete">{{ trans('admin_content.del') }}</th>
                                                </tr>
                                                @foreach ($data['mass_media'] as $mm)
                                                    <tr role="row" id="{{ 'mm_'.$mm->id }}">
                                                        <td class="id">{{ $mm->id }}</td>
                                                        <td class="image"><a href="{{ asset($mm->full) }}" {{ !$mm->is_pdf ? 'data-popup=lightbox' : 'target=_blank' }}><img src="{{ asset($mm->preview).'?dummy='.md5(rand(0,10000)) }}" /></a></td>
                                                        <td class="text-center"><a href="/admin/mass-media/?id={{ $mm->id }}">{{ $mm['description_'.App::getLocale()] }}</a></td>
                                                        <th class="text-center">{{ $mm->year }}</th>
                                                        <th class="text-center"><span class="label label-{{ $mm->is_pdf ? 'success' : 'info' }}">{{ $mm->is_pdf ? 'PDF' : 'JPG' }}</span></th>
                                                        <td class="delete"><span del-data="{{ $mm->id }}" modal-data="delete-media-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            {{ $data['mass_media']->render() }}
                                            @include('admin._add_button_block',['href' => 'mass-media/add', 'text' => trans('admin_content.add_mass_media')])
                                        </div>
                                    @endif
                                </div>
                            @elseif ($data['sub_chapter']->have_a_resources)
                                @include('admin._modal_delete_block',['modalId' => 'delete-resource-modal', 'function' => 'delete-resource', 'head' => trans('admin_content.do_you_really_want_to_delete_this_resource')])

                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">{{ trans('admin_content.sub_chapters_mass_media') }}</h4>
                                        @include('admin._add_button_block',['href' => 'resource/add', 'text' => $data['sub_chapter']->id == 7 ? trans('admin_content.add_video') : trans('admin_content.add_resource')])
                                    </div>
                                    @if (count($data['sub_chapter']->resources))
                                        <div class="panel-body">
                                            <table class="table table-striped table-items">
                                                <tr>
                                                    <th class="id">Id</th>
                                                    <th width="30%" class="image text-center">{{ $data['sub_chapter']->id == 7 ? trans('admin_content.video') : trans('admin_content.logo') }}</th>
                                                    <th class="text-center">{{ trans('admin_content.description') }}</th>
                                                    <th class="delete">{{ trans('admin_content.del') }}</th>
                                                </tr>
                                                @foreach ($data['sub_chapter']->resources as $resource)
                                                    <tr role="row" id="{{ 'resource_'.$resource->id }}">
                                                        <td class="id">{{ $resource->id }}</td>
                                                        <td class="image">
                                                            @if ($data['sub_chapter']->id == 7)
                                                                {!! $resource->url !!}
                                                            @else
                                                                <a href="{{ $resource->url }}" target="_blank"><img src="{{ asset($resource->logo).'?dummy='.md5(rand(0,10000)) }}" /></a>
                                                            @endif
                                                        </td>
                                                        <td class="text-center"><a href="/admin/resource/?id={{ $resource->id }}">{{ $resource['description_'.App::getLocale()] ? $resource['description_'.App::getLocale()] : trans('admin_content.edit') }}</a></td>
                                                        <td class="delete"><span del-data="{{ $resource->id }}" modal-data="delete-resource-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                            @include('admin._add_button_block',['href' => 'resource/add', 'text' => $data['sub_chapter']->id == 7 ? trans('admin_content.add_video') : trans('admin_content.add_resource')])
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if (!count($data['sub_chapter']->reviews) && !count($data['sub_chapter']->results) && !count($data['sub_chapter']->massMedia) && !count($data['sub_chapter']->resources))
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
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection