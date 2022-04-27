@if (isset($data['metas']) && count($data['metas']))
    <div class="panel-group panel-group-control panel-group-control-right content-group-lg" id="accordion-control-right">
        <div class="panel panel-white">
            <div class="panel-heading">
                <h6 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion-control-right" href="#accordion-control-right-group">{{ trans('admin_content.seo_block') }}</a>
                </h6>
            </div>
            <div id="accordion-control-right-group" class="panel-collapse collapse">
                <div class="panel-body">
                    @include('admin._input_block', [
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                        'placeholder' => 'Title',
                        'value' => isset($chapter) && $chapter ? $chapter['title'] : ''
                    ])
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">{{ trans('admin_content.meta_tags') }}</h4>
                </div>
                <div class="panel-body">
                    @foreach($data['metas'] as $meta => $params)
                        @if ($params['name'] == 'description' || $params['name'] == 'keywords' || $params['property'] == 'og:description')
                            @include('admin._textarea_block', [
                                'label' => $params['name'] ? 'name="'.$params['name'].'"' : 'property="'.$params['property'].'"',
                                'name' => $meta,
                                'value' => isset($chapter) && $chapter ? $chapter[$meta] : '',
                                'simple' => true
                            ])
                        @else
                            @include('admin._input_block', [
                                'name' => $meta,
                                'type' => 'text',
                                'placeholder' => $params['name'] ? 'name="'.$params['name'].'"' : 'property="'.$params['property'].'"',
                                'value' => isset($chapter) && $chapter ? $chapter[$meta] : ''
                            ])
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
        {{--<div class="panel panel-flat">--}}
            {{----}}
        {{--</div>--}}
    {{--</div>--}}
@endif