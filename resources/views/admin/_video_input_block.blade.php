<div class="form-group has-feedback has-feedback-left {{ isset($addClass) ? $addClass : '' }} {{ $error ? 'has-error' : '' }}">
    <div>
        <input style="padding-left: 45px;" name="video_url[]" type="text" class="form-control" placeholder="{{ trans('admin_content.video_url') }}" value="{{ isset($value) ? $value : '' }}">
        <div class="form-control-feedback">
            <i class="icon-youtube3 text-muted"></i>
        </div>
        @if (isset($error) && $error)
            <span class="help-block">{{ $error }}</span>
        @endif
    </div>
</div>