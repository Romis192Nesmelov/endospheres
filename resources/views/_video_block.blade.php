<div class="col-lg-{{ isset($col) ? $col : '6' }} col-md-{{ isset($col) ? $col : '6' }} col-sm-{{ isset($col) ? $col : '6' }} col-xs-12 {{ isset($addClass) ? $addClass : '' }}">
    {!! $video->url !!}
    @if (isset($video['head_'.App::getLocale()]) && $video['head_'.App::getLocale()] && isset($video['description_'.App::getLocale()]) && $video['description_'.App::getLocale()])
        <div class="subscribe">
            <h3>{{ $video['head_'.App::getLocale()] }}</h3>
            <p>{{ $video['description_'.App::getLocale()] }}</p>
        </div>
    @endif
</div>