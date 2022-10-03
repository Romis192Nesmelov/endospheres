<nav class="navbar navbar-default navbar-static-top">

    <div class="container">
        <div class="logo"><a href="/home"><img src="{{ asset('images/logo.png?'.(md5(rand(0,100)))) }}" alt="Logo" /></a></div>

        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav dropdown {{ isset($data['chapter']) && $data['chapter']->id != 1 && $data['chapter']->id != 9 ? 'visible-xs' : '' }}">
                @foreach ($items as $item)
                    <li class="{{ Request::path() == $item['href'] ? 'active ' : ''}}">
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
        </div>
    </div>
</nav>