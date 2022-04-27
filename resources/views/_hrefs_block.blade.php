<ul class="hrefs">
    @foreach($items as $item)
        <li class="blue head" data-head="{{ $item->id }}"><div class="href">{{ $item[$head] }}</div><div class="label hidden-xs"><div>{{ $labelType == 'static' ? $label : ($labelType == 'date' ? date('d.m.Y',$item[$label]) : $item[$label]) }}</div></div></li>
        <li class="content" data-content="{{ $item->id }}">
            {!! $item[$content] !!}
            @if (isset($item->slug) && isset($prefix))
                <a href="/{{ $prefix }}/{{ $item->slug }}">{{ trans('content.read_more') }}</a>
            @endif
        </li>
    @endforeach
</ul>