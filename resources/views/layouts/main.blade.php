<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Endospheres therapy</title>

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/dm3Slideshow.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" >

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <!-- /core JS files -->

    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/media/fancybox.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/pages/components_thumbnails.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/dm3Slideshow.jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/feedback.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
</head>
<body>

@include('layouts._modal_block',['id' => 'message', 'message' => trans('content.thanks_for_your_message')])
@include('layouts._feedback_modal_block')

@include('layouts._nav_top_block', ['items' => $mainMenu])

@if (isset($data['chapter']) && $data['chapter']->id == 1)
    @include('layouts._slider_block',['slides' => $data['slider']])
@endif

@yield('content')

@include('layouts._footer_block')

<script>window.assetImages = "{{ asset('images') }}"</script>

</body>
</html>
