@if ($slide)
    <div id="slider-chapter" class="hidden-xs"><img {!! isset($title) ? 'title="'.$title.'"' : '' !!} src="{{ asset('images/chapters_slides/'.$slide) }}" /></div>
    @if ($showLicense)
        <p class="license hidden-xs">{{ trans('content.license') }}</p>
    @endif
@endif