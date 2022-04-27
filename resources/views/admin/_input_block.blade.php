<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <label class="control-label col-md-1 col-sm-1 col-xs-12 text-semibold">{{ $label }}</label>
    @endif
    <div class="col-md-{{ (isset($label) && $label) ? '11' : '12' }} col-sm-{{ (isset($label) && $label) ? '11' : '12' }} col-xs-12">
        <input {{ isset($min) && $min ? 'min='.$min : '' }} {{ isset($max) && $max ? 'max='.$max : '' }} name="{{ $name }}" type="{{ $type }}" class="form-control" placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}" value="{{ isset($value) && !count($errors) ? $value : old($name) }}">
        @if ($errors && $errors->has($name))
            <span class="help-block">{{ $errors->first($name) }}</span>
        @endif
    </div>
</div>