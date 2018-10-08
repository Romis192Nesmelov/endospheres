@if (isset($data['metas']) && count($data['metas']))
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-flat">
            <div class="panel-body">
                @include('admin._input_block', [
                    'label' => 'Title',
                    'name' => 'title',
                    'type' => 'text',
                    'placeholder' => 'Title',
                    'value' => isset($chapter) && $chapter ? $chapter->title : ''
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
@endif