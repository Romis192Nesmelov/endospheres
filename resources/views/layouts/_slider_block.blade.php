<!-- SLIDESHOW -->
{{--<div id="slideshow_wrap" {{ Request::path() == '/' ? '' : 'class=slim' }}>--}}
<div id="slideshow_wrap" class="hidden-xs">
    <div id="slideshow">
        {{--@if (count($slides) > 1)--}}
            {{--<div class="slideshow_controls">--}}
                {{--<a class="prev" href="#" title="Previous"></a>--}}
                {{--<a class="start" href="#"></a>--}}
                {{--<a class="next" href="#" title="Next"></a>--}}
            {{--</div>--}}
        {{--@endif--}}

        <ul>
            @foreach ($slides as $slide)
                <li>
                    {{--<img src="/images/slider/{{ $slide }}" width="1600" height="{{ Request::path() == '/' ? '500' : '350'  }}" />--}}
                    <img src="{{ asset('images/slider/'.$slide) }}" width="1920" height="414" />
                    {{--<div class="slideshow_info col-md-offset-2 col-sm-offset-1 hidden-xs">--}}
                        {{--<div class="slideshow_info_top">--}}
                            {{--<h2>{{ trans('content.slider_main_header') }}</h2>--}}
                            {{--<p>{!! trans('content.slider_main_text') !!}</p>--}}
                        {{--</div>--}}
                        {{--<div class="slideshow_info_bottom"></div>--}}
                    {{--</div>--}}
                </li>
            @endforeach
        </ul>
        <p>{{ trans('content.license') }}</p>
    </div>
    {{--<div id="slideshow_shadow"></div>--}}
</div>