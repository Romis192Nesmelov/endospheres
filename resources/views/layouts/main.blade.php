<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KF-Expo</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
    <link href="/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="/css/bootstrap-switch.css" rel="stylesheet">
    <link href="/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="/css/core.css" rel="stylesheet" type="text/css">
    <link href="/css/components.css" rel="stylesheet" type="text/css">
    <link href="/css/colors.css" rel="stylesheet" type="text/css">
    <link href="/css/style.css" rel="stylesheet" type="text/css" >

    <!-- Core JS files -->
    <script type="text/javascript" src="/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="/js/core/libraries/bootstrap.min.js"></script>
    <!-- /core JS files -->

    <script type="text/javascript" src="/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="/js/plugins/forms/styling/bootstrap-switch.js"></script>
    <script type="text/javascript" src="/js/plugins/media/fancybox.min.js"></script>

    <script type="text/javascript" src="/js/pages/components_thumbnails.js"></script>
    <script type="text/javascript" src="/js/core/main.controls.js"></script>

    <script type="text/javascript" src="/js/feedback.js"></script>

    <script type="text/javascript" src="/js/jquery.stellar.min.js"></script>
    <script type="text/javascript" src="/js/scrollreveal.min.js"></script>
    <script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
</head>
<body>

@include('layouts._modal_block',['id' => 'message', 'message' => trans('content.thanks_for_your_message')])
@include('layouts._feedback_modal_block')

{{--<nav class="navbar navbar-default navbar-static-top">--}}
    {{--<div class="logo medium hidden-lg hidden-md hidden-sm"><img src="/images/logo.png" alt="Logo" /></div>--}}
    {{--<div class="container">--}}
        {{--<div class="navbar-header">--}}
            {{--<!-- Collapsed Hamburger -->--}}
            {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">--}}
                {{--<span class="sr-only">Toggle Navigation</span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
                {{--<span class="icon-bar"></span>--}}
            {{--</button>--}}
        {{--</div>--}}

        {{--<div class="collapse navbar-collapse" id="app-navbar-collapse">--}}
            {{--<div class="logo small hidden-xs"><a href="#slide1" data-scroll="1"><img src="/images/logo.png" alt="Logo" /></a></div>--}}

            {{--<!-- Left Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--@for ($i=0;$i<count($data);$i++)--}}
                    {{--<li class="main-menu {{ !$i ? 'active first' : '' }}">--}}
                        {{--<a href="#slide{{ $data[$i]->id }}" data-scroll="{{ $data[$i]->id }}">{{ $data[$i]['head_'.App::getLocale()] }}</a>--}}
                    {{--</li>--}}

                    {{--<?php ob_start(); ?>--}}
                    {{--<style>--}}
                        {{--@media screen and (min-width: 1920px) {--}}
                            {{--.slide.slide{{ $data[$i]->id }}--}}
                            {{--{--}}
                                {{--background-image: url(/images/slides/slide{{ $data[$i]->id }}/1920x1080.jpg);--}}
                            {{--}--}}
                        {{--}--}}
                        {{--@foreach ($screenSizes as $size)--}}
                            {{--@media screen and (max-width: {{ $size['width'] }}px) {--}}
                            {{--.slide.slide{{ $data[$i]->id }}--}}
                                {{--{--}}
                                {{--background-image: url(/images/slides/slide{{ $data[$i]->id }}/{{ $size['width'].'x'.$size['height'] }}.jpg);--}}
                            {{--}--}}
                        {{--}--}}
                        {{--@endforeach--}}
                    {{--</style>--}}

                    {{--@include('_slide_block',['data' => $data[$i], 'prevId' => ($i ? $data[$i-1]->id : null), 'nextId' => ($i != count($data)-1 ? $data[$i+1]->id : null)])--}}
                    {{--<?php $bodyContent .= ob_get_clean(); ?>--}}
                {{--@endfor--}}

                {{--<li class="main-menu">--}}
                    {{--<a href="#feedback_modal" data-toggle="modal">{{ trans('content.feedback_message') }}</a>--}}
                {{--</li>--}}
            {{--</ul>--}}

            {{--<!-- Right Side Of Navbar -->--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="lang" src="/images/{{ App::getLocale() }}.png"> <span class="caret"></span></a>--}}
                    {{--<ul class="dropdown-menu" role="menu">--}}
                        {{--<li><a href="{{ url('/change-lang?lang=ru') }}"><img class="lang" src="/images/ru.png"> Русский</a></li>--}}
                        {{--<li><a href="{{ url('/change-lang?lang=en') }}"><img class="lang" src="/images/en.png"> English</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}

@yield('content')

</body>
</html>
