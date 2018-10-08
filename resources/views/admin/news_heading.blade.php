@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-modal', 'function' => 'delete-news', 'head' => trans('admin_content.do_you_really_want_to_delete_this_news')])
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ isset($data['heading']) ? $data['heading']['head_'.App::getLocale()] : trans('admin_content.add_heading_news') }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/news-heading') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['heading']))
                    <input type="hidden" name="id" value="{{ $data['heading']->id }}">
                @endif

                @include('admin._meta_tags_block',['chapter' => isset($data['heading']) ? $data['heading'] : null])

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._image_block', ['item' => 'heading', 'folder' => 'chapters_slides', 'height' => 169, 'name' => 'slide'])
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
                                'value' => isset($data['heading']) ? $data['heading']->head_ru : ''
                            ])

                            @include('admin._textarea_block', [
                                'label' => trans('admin_content.subscribe'),
                                'name' => 'subscribe_ru',
                                'value' => isset($data['heading']) ? $data['heading']->subscribe_ru : '',
                                'simple' => true
                            ])

                            @include('admin._button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="panel-body">
            @if (isset($data['heading']))
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h4 class="panel-title">{{ trans('admin_content.chapter_news') }}</h4>
                        @include('admin._add_button_block',['href' => 'news/add-news', 'text' => trans('admin_content.add_news')])
                    </div>
                    <div class="panel-body">
                        @if (count($data['heading']->news))
                            <table class="table datatable-basic table-items">
                                <tr>
                                    <th class="text-center">{{ trans('admin_content.head') }}</th>
                                    <th class="text-center">{{ trans('admin_content.description') }}</th>
                                    <th class="text-center">{{ trans('admin_content.content') }}</th>
                                    <th class="text-center">{{ trans('admin_content.date') }}</th>
                                    <th class="text-center">{{ trans('admin_content.status') }}</th>
                                    <th class="delete">{{ trans('admin_content.del') }}</th>
                                </tr>
                                @foreach ($data['heading']->news as $news)
                                    <tr role="row" id="{{ 'news_'.$news->id }}">
                                        <td class="text-center"><h4><a href="/admin/news/?id={{ $news->id }}">{{ $news['head_'.App::getLocale()] }}</a></h4></td>
                                        <td class="text-left">{{ mb_substr(strip_tags($news['description_'.App::getLocale()]), 0, 200) }}</td>
                                        <td class="text-left">{{ mb_substr(strip_tags($news['content_'.App::getLocale()]), 0, 500) }}</td>
                                        <td class="text-center">{{ date('d.m.Y', $news->time) }}</td>
                                        <td class="text-center">@include('admin._active_status_block',['item' => $news])</td>
                                        <td class="delete"><span del-data="{{ $news->id }}" modal-data="delete-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                        @include('admin._add_button_block',['href' => 'news/add-news', 'text' => trans('admin_content.add_news')])
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection