<div data-logo="{{ $logo }}" class="href-image" {{ isset($width) ? 'style=width:'.$width : '' }}>
    <a href="{{ $href }}">
        <div class="image-frame">
            <img class="device" {!! isset($title) ? 'title="'.$title.'"' : '' !!} src="{{ $image }}" />
        </div>
        {!! $description !!}
    </a>
</div>