<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if (isset($data['chapter']))
        @if ($data['chapter']->id == 3)
            @include('layouts._tags_block',['chapter' => $data['device']])
        @elseif ($data['chapter']->id == 6)
            @include('layouts._tags_block',['chapter' => $data['heading']])
        @elseif ($data['chapter']->id == 5 || $data['chapter']->id == 8)
            @include('layouts._tags_block',['chapter' => $data['sub_chapter']])
        @else
            @include('layouts._tags_block',['chapter' => $data['chapter']])
        @endif
    @else
        <title>{{ Request::path() == 'all-truth-about' ? 'Вся правда о...' : 'Endospheres therapy' }}</title>
    @endif

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

<!— Yandex.Metrika counter —>
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter44462833 = new Ya.Metrika({
                    id:44462833,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/44462833" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!— /Yandex.Metrika counter —>

<?php /*
Cookie::get('name');
  Cookie::put('name', 'Fred', 60);
    setcookie('ny_work', true, time()+(60 * 60 * 24));*/
?>


@include('layouts._modal_block',['id' => 'message', 'message' => trans('content.thanks_for_your_message')])
{{--@include('layouts._feedback_modal_block')--}}
@if (!isset($_COOKIE['cookie']))
    @include('layouts._cookie_modal_block')
    <?php setcookie('cookie', true, time()+(60 * 60 * 24)); ?>
@endif

@include('layouts._nav_top_block', ['items' => $mainMenu])

@if (isset($data['chapter']) && $data['chapter']->id == 1)
    @include('layouts._slider_block',['slides' => $data['slider']])
@endif

@yield('content')

@include('layouts._footer_block')

<script>window.assetImages = "{{ asset('images') }}"</script>

</body>
</html>
