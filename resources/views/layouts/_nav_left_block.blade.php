<ul class="navigation navigation-main navigation-accordion hidden-xs">
    @foreach ($items as $item)
        <li class="{{ ( preg_match('/^'.str_replace('/','\/',$item['href']).'/',Request::path()) ) ? 'active ' : ''}}">
            <a href="/{{ $item['href'] }}">{{ $item['name'] }}</a>
            @if (isset($item['submenu']) && count($item['submenu']))
                <ul class="dropdown-menu">
                    @foreach($item['submenu'] as $submenu)
                        <li><a href="{{ $submenu['href'] }}">{{ $submenu['name'] }}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach
</ul>