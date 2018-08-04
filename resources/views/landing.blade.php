<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Endospheres therapy</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="/css/landing.css" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/js/landing.js"></script>
</head>
<body>

<!--Подложка (предыдущий слайд)-->
<svg viewBox="0 0 1920 1080" width="100%" height="100%" preserveAspectRatio="xMidYMid slice">
    <image id="background-image" width='100%' height='100%' xlink:href='/images/landing/main.jpg' />
</svg>
<!--/Подложка-->

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
    <div id="mouse"><div></div></div>
    {!! trans('landing.move_mouse_wheel_to_continue') !!}
</div>

<div id="footer">
    <table id="all-truth" class="text hidden">
        <tr>
            <td class="slide-number current">!</td>
            <td>{{ trans('landing.all_truth_about') }}</td>
        </tr>
    </table>

    <table class="hidden" id="reasons">
        <tr>
            <td class="slide-number current" rowspan="2"></td>
            <td class="slide-number total"></td>
        </tr>
        <tr>
            <td class="text"></td>
        </tr>
    </table>
</div>

<div id="hrefs">
    <a class="skip" href="#">{{ trans('landing.skip_intro') }}</a>
    <a href="#">{{ trans('landing.redirect_to_italy_site') }}</a>
    <img src="/images/italy_flag.gif" />
</div>

<div id="logo"></div>
<script>
    window.slides = [];
    window.currentSlide = 0;
    window.reasonsCount = 1;
    window.imagesCount = 0;
    @foreach($slides as $slide)
        window.slides.push({
            'path':"{{ $slide->path }}",
            'head':"{{ $slide['head_'.App::getLocale()] }}",
            'description':"{!! $slide['description_'.App::getLocale()] !!}",
            'is_image':parseInt("{{ $slide->is_image }}")
        });

        @if ($slide->is_image)
            window.imagesCount++;
        @endif
    @endforeach
</script>

</body>
</html>
