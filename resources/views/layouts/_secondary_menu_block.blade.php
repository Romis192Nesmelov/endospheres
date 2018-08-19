@foreach($items as $item)
    <a href="/{{ $prefix }}/{{ $item->slug }}">
        <div class="secondary-menu {{ $activeId == $item->id ? 'active' : '' }}">
            <div class="menu-item">{{ $item['head_'.App::getLocale()] }}</div>
        </div>
    </a>
@endforeach