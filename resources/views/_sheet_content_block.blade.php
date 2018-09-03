<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <ul class="navigation navigation-main navigation-accordion sheet-menu hidden-xs">
        @foreach ($data as $k => $item)
            @if ($item->active)
                <li class=" {{ !$k ? 'active ' : ''}}">
                    <a href="#{{ $item->id }}">{{ $item->head }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</div>

<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
    @foreach ($data as $item)
        @if ($item->active)
            <a name="{{ $item->id }}"></a>
            <div class="publication-date">{{ trans('content.published', ['date' => date('d.m.Y', $item->time)]) }}</div>
            <h2>{{ $item->head }}</h2>
            <div class="sheet-content">{!! $item->content !!}</div>
        @endif
    @endforeach
</div>

<div id="on_top_button"><i class="glyphicon glyphicon-upload"></i></div>