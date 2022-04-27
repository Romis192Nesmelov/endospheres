@extends('layouts.admin')

@section('content')
    @include('admin._modal_delete_block',['modalId' => 'delete-file-modal', 'function' => 'delete-file', 'head' => trans('admin_content.do_you_really_want_to_delete_this_file')])
    @include('admin._modal_delete_block',['modalId' => 'delete-question-modal', 'function' => 'delete-question', 'head' => trans('admin_content.do_you_really_want_to_delete_this_question')])
    @include('admin._modal_delete_block',['modalId' => 'delete-sheet-modal', 'function' => 'delete-sheet', 'head' => trans('admin_content.do_you_really_want_to_delete_this_position')])
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h4 class="panel-title">{{ $data['chapter']['head_'.App::getLocale()] }}</h4>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/chapter') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $data['chapter']->id }}">

                @include('admin._meta_tags_block',['chapter' => $data['chapter']])

                @if ($data['chapter']->slide)
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            @include('admin._image_block', ['item' => 'chapter', 'folder' => 'chapters_slides', 'height' => 169, 'name' => 'slide'])
                            <div class="panel-body">
                                @include('admin._textarea_block', [
                                    'label' => trans('admin_content.subscribe'),
                                    'name' => 'subscribe_'.App::getLocale(),
                                    'value' => $data['chapter']['subscribe_'.App::getLocale()],
                                    'simple' => true
                                ])
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">

                            @if (!$data['chapter']->have_a_sheet)
                                @include('admin._input_block', [
                                    'label' => trans('admin_content.head'),
                                    'name' => 'head_ru',
                                    'type' => 'text',
                                    'placeholder' => trans('admin_content.head'),
                                    'value' => $data['chapter']->head_ru
                                ])

                                @if ($data['chapter']->id != 3 && $data['chapter']->id != 4 && $data['chapter']->id != 6 && !count($data['chapter']->subChapters))
                                    @include('admin._textarea_block', [
                                        'label' => trans('admin_content.content'),
                                        'name' => 'content_ru',
                                        'value' => $data['chapter']->content_ru,
                                        'simple' => false
                                    ])
                                @endif

                                @if (isset($data['news_heading']))
                                    <table class="table table-striped table-items">
                                        <tr>
                                            <th width="30%" class="text-center">{{ trans('admin_content.head') }}</th>
                                            <th class="text-center">{{ trans('admin_content.subscribe') }}</th>
                                        </tr>
                                        @foreach ($data['news_heading'] as $heading)
                                            <tr role="row">
                                                <td class="text-left"><h3><a href="/admin/news/{{ $heading->slug }}">{{ $heading['head_'.App::getLocale()] }}</a></h3></td>
                                                <td class="text-left">@include('admin._substr_block', ['string' => $heading['subscribe_'.App::getLocale()], 'length' => 1000])</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @include('admin._add_button_block',['href' => 'news/news-heading-add', 'text' => trans('admin_content.add_heading_news')])
                                @endif

                                @if (count($data['chapter']->devices))
                                    <table class="table datatable-basic table-items">
                                        <tr>
                                            <th class="text-center">{{ trans('admin_content.logo') }}</th>
                                            <th class="text-center device">{{ trans('admin_content.image_simple') }}</th>
                                            <th class="text-center">{{ trans('admin_content.name') }}</th>
                                            <th class="text-center">{{ trans('admin_content.head') }}</th>
                                            <th class="text-center">{{ trans('admin_content.active') }}</th>
                                            <th class="text-center">{{ trans('admin_content.status') }}</th>
                                        </tr>
                                        @foreach ($data['chapter']->devices as $device)
                                            <tr role="row">
                                                <td class="text-center"><div class="device-logo"><img src="{{ asset('images/'.$device->menu_logo) }}" /></div></td>
                                                <td class="text-center device"><img src="{{ asset('images/devices/'.$device->image) }}" /></td>
                                                <td class="text-center"><h3><a href="/admin/chapters/{{ $data['chapter']->slug.'/'.$device->slug }}">{{ $device->name }}</a></h3></td>
                                                <td class="text-center"><h4>{{ trans('content.endosphere').' '.$device['head_'.App::getLocale()] }}</h4></td>
                                                <td class="text-center">@include('admin._active_status_block', ['item' => $device])</td>
                                                <td class="text-center">@include('admin._new_status_block', ['item' => $device])</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @include('admin._add_button_block',['href' => 'chapters/'.$data['chapter']->slug.'/add', 'text' => trans('admin_content.add_device')])
                                @endif
                            @else
                                <div class="panel-heading">
                                    @include('admin._add_button_block',['href' => 'recommendation/add', 'text' => trans('admin_content.add_recommendations')])
                                </div>
                                @include('admin._sheets_table_block',['data' => $data['chapter']->sheets, 'suffix' => 'recommendation'])
                            @endif
                        </div>
                    </div>

                    @if (count($data['chapter']->subChapters))
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h4 class="panel-title">{{ trans('admin_content.sub_chapters') }}</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-items">
                                <tr>
                                    <th class="text-left">{{ trans('admin_content.head') }}</th>
                                </tr>
                                @foreach ($data['chapter']->subChapters as $subChapter)
                                    <tr role="row">
                                        <td class="text-left"><h4><a href="/admin/sub-chapter/{{ $subChapter->slug }}">{{ $subChapter['head_'.App::getLocale()] }}</a></h4></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif

                    @if ($data['chapter']->have_a_questions)
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h4 class="panel-title">{{ trans('admin_content.chapter_questions') }}</h4>
                                @include('admin._add_button_block',['href' => 'question/add', 'text' => trans('admin_content.add_question')])
                            </div>
                            <div class="panel-body">
                                @if (count($data['chapter']->questions))
                                    <table class="table table-striped table-items">
                                        <tr>
                                            <th class="id">Id</th>
                                            <th class="image text-center">{{ trans('admin_content.question') }}</th>
                                            <th class="text-center">{{ trans('admin_content.answer') }}</th>
                                            <th class="delete">{{ trans('admin_content.del') }}</th>
                                        </tr>
                                        @foreach ($data['chapter']->questions as $questions)
                                            <tr role="row" id="{{ 'question_'.$questions->id }}">
                                                <td class="id">{{ $questions->id }}</td>
                                                <td class="text-left"><a href="/admin/question/?id={{ $questions->id }}">{{ $questions['question_'.App::getLocale()] }}</a></td>
                                                <td class="text-left">@include('admin._substr_block', ['string' => strip_tags($questions['answer_'.App::getLocale()]), 'length' => 500])</td>
                                                <td class="delete"><span del-data="{{ $questions->id }}" modal-data="delete-question-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @include('admin._add_button_block',['href' => 'question/add', 'text' => trans('admin_content.add_question')])
                                @endif
                            </div>
                        </div>
                    @endif

                    @if ($data['chapter']->have_a_video)
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h4 class="panel-title">{{ trans('admin_content.chapter_video') }}</h4>
                            </div>
                            @if (count($data['chapter']->videos))
                                <div class="panel-body">
                                    @foreach($data['chapter']->videos as $video)
                                        @include('admin._video_input_block', ['video' => $video])
                                    @endforeach
                                </div>
                            @endif
                            <div class="panel-body">
                                @for($i=0;$i<10;$i++)
                                    @include('admin._video_input_block', ['video' => '', 'addClass' => 'new-video'])
                                @endfor

                                @include('_button_block', [
                                    'addAttr' => ['id' => 'addVideo'],
                                    'type' => 'button',
                                    'icon' => 'icon-database-add',
                                    'text' => trans('admin_content.add_video'),
                                    'mainClass' => 'bg-primary-400',
                                    'addClass' => 'pull-right'
                                ])
                            </div>
                        </div>
                    @endif

                    @if ($data['chapter']->have_a_files)
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h4 class="panel-title">{{ trans('admin_content.chapter_files') }}</h4>
                                @include('admin._add_button_block',['href' => 'file/add', 'text' => trans('admin_content.add_file')])
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped table-items">
                                    <tr>
                                        <th class="id">Id</th>
                                        <th width="15%" class="image text-center">{{ trans('admin_content.file_simple') }}</th>
                                        <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
                                        <th class="text-center">{{ trans('admin_content.description') }}</th>
                                        <th class="delete">{{ trans('admin_content.del') }}</th>
                                    </tr>
                                    @foreach ($data['chapter']->files as $file)
                                        <tr role="row" id="{{ 'file_'.$file->id }}">
                                            <td class="id">{{ $file->id }}</td>
                                            <td class="text-center"><a href="/admin/file/?id={{ $file->id }}"><i class="{{ $file->type == 'pdf' ? 'icon-file-pdf' : 'icon-file-word' }}"></i> {{ pathinfo($file->path)['basename'] }}</a></td>
                                            <td class="text-center">{{ $file['head_'.App::getLocale()] }}</td>
                                            <td class="text-left">@include('admin._substr_block', ['string' => strip_tags($file['description_'.App::getLocale()]), 'length' => 500])</td>
                                            <td class="delete"><span del-data="{{ $file->id }}" modal-data="delete-file-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                        </tr>
                                    @endforeach
                                </table>

                                @include('admin._add_button_block',['href' => 'file/add', 'text' => trans('admin_content.add_file')])
                            </div>
                        </div>
                    @endif

                    <div class="panel panel-flat">
                        @include('_checkbox_block', ['name' => 'active', 'label' => trans('admin_content.active'), 'checked' => $data['chapter']->active])
                    </div>

                </div>
                @include('_button_block', ['type' => 'submit', 'icon' => ' icon-floppy-disk', 'text' => trans('admin_content.save'), 'mainClass' => 'bg-primary-400', 'addClass' => 'pull-right'])
            </form>
        </div>
    </div>
@endsection