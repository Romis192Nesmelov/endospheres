<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('layouts._tags_block',['chapter' => Settings::getLandingTags()])

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/landing.css') }}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.mousewheel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landing.js') }}"></script>
</head>
<body>

<div id="white-field"></div>
<script>
    window.slides = [];
    window.currentSlide = 0;
    window.reasonsCount = 1;
    window.imagesCount = 0;
    @foreach($slides as $slide)
        window.slides.push({
            'id':"{{ $slide->id }}",
            'path':"{{ asset($slide->path) }}",
            'head':"{{ $slide['head_'.App::getLocale()] }}",
            'description':"{!! $slide['description_'.App::getLocale()] !!}",
            'background_color':"{{ $slide->background_color }}",
            'mouse_color':"{{ $slide->mouse_color }}",
            'is_image':parseInt("{{ $slide->is_image }}")
        });
        @if ($slide->is_image)
            window.imagesCount++;
        @else
            $('body').prepend('<div id="video-container-{{ $slide->id }}" class="video-slide"><video id="video-{{ $slide->id }}" muted="muted" preload="auto" loop="loop" preload="auto" {{ $slide->poster ? 'poster='.asset($slide->poster) : '' }}><source src="{{ asset($slide->path) }}.mp4"><source src="{{ asset($slide->path) }}.3gp"><source src="{{ asset($slide->path) }}.mov"><source src="{{ asset($slide->path) }}.avi"></video></div>');
        @endif
    @endforeach
</script>

<div id="main-container">
    <!--Подложка (предыдущий слайд)-->
    <svg viewBox="0 0 1920 1080" width="100%" height="100%" preserveAspectRatio="xMidYMid slice">
        <image id="background-image" width='100%' height='100%' xlink:href="{{ asset('images/landing/main.jpg?'.(md5(rand(0,100)))) }}" />
    </svg>
    <!--/Подложка-->

    <!--Цифры-->
    <svg id="digits-mask-svg" viewBox="0 0 1920 1080" width="100%" height="100%" preserveAspectRatio="xMidYMid slice">
        <defs>
            <mask id="digits-mask" x="0" y="0" width="100%" height="100%">
                <rect x="773" y="772" width="55" height="80" />
            </mask>
        </defs>
        <image id="digits" width='100%' height='100%' xlink:href="{{ asset('images/landing/digits.png') }}" />
    </svg>
    <!--/Цифры-->

    <!--Прямая маска (прилетающие сверху цифры)-->
    <svg id='linear1-mask-svg' viewBox="0 0 1920 1080" width="100%" height="100%" preserveAspectRatio="xMidYMid slice">
        <defs>
            <mask id='linear1-mask' x='0' y='0' width='100%' height='100%'>
                <text class="decades" x='46%' y='0%' fill='#fff'></text>
                <text class="units" x='54%' y='0%' fill='#fff'></text>
            </mask>
        </defs>
        <image width='100%' height='100%' xlink:href='' />
    </svg>
    <!--/Прямая маска-->

    <!--Инверсная маска (накрывающий снизу слайд)-->
    <svg id="invert1-mask-svg" viewBox="0 0 1920 1080" width="100%" height="100%" preserveAspectRatio="xMidYMid slice">
        <defs>
            <mask id="invert1-mask" x="0" y="100%" width="100%" height="100%">
                <rect x="0" y="0" width="100%" height="100%"/>
            </mask>
        </defs>
        <image width='100%' height='100%' xlink:href='' />
    </svg>
    <!--/Инверсная маска-->

    <div id="ten-reasons-container">
        <div class="reasons-text top">{{ trans('landing.reasons') }}</div>
        <div class="big-digits">
            <div class="decades"><div>0</div></div>
            <div class="units"><div>0</div></div>
        </div>
        <div class="reasons-text">{!! trans('landing.get_acquainted_with_the_methodology') !!}</div>
    </div>

    <div class="hidden" id="mouse-container">
        <div id="mouse-click-container">
            <div class="icon-mouse-left"></div>
            {!! trans('landing.click_mouse_button_to_continue') !!}
        </div>

        <div class="hidden" id="mouse-scroll-container">
            <div id="mouse-scroll"><div></div></div>
            <div id="wheel-to-continue">{!! trans('landing.move_mouse_wheel_to_continue') !!}</div>
            <div id="scroll-to-continue">{!! trans('landing.move_mouse_scroll_to_continue') !!}</div>
        </div>
    </div>

    <a href="{{ url('/home') }}"><div id="button" class="hidden">{{ trans('landing.go_to_site') }}</div></a>

    <div id="footer">
        <table class="hidden" id="reasons">
            <tr>
                <td class="slide-number current" rowspan="2">01</td>
                <td class="slide-number total">10</td>
            </tr>
            <tr>
                <td class="text"></td>
            </tr>
        </table>
    </div>
</div>

<div id="hrefs">
    <a class="skip" href="/home">{{ trans('landing.skip_intro') }}</a>
    <a href="https://www.endospheres.com/" target="_blank">{{ trans('landing.redirect_to_italy_site') }}<img src="{{ asset('images/italy_flag.gif') }}" /></a>
    <span class="hidden glyphicon {{ isset($_COOKIE['muted']) && $_COOKIE['muted'] ? 'glyphicon-volume-up' : 'glyphicon-volume-off' }}"></span>
</div>

<div id="logo" class="hidden"><img src="{{ asset('images/logo_white.png') }}" /></div>

<audio id="welcome" preload="auto" muted="muted">
    <source src="{{ asset('audio/welcome.mp3') }}" type="audio/mpeg">
</audio>

<audio id="music" loop preload="auto" muted="muted">
    <source src="{{ asset('audio/music.mp3') }}" type="audio/mpeg">
</audio>

</body>
</html>
