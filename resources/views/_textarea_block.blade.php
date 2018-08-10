<div class="clearfix form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <label class="for="{{ $name }}">{{ $label }}</label>
    @endif
    <textarea class="form-control" {{ isset($placeholder) && $placeholder ? 'placeholder='.$placeholder : '' }} name="{{ $name }}">{{ count($errors->getMessageBag()) ? old($name) : (isset($value) ? $value : '') }}</textarea>

    @if ($errors && $errors->has($name) || (isset($useAjax) && $useAjax))
        <div class="form-control-feedback">
            <i class="icon-cancel-circle2"></i>
        </div>
        <span class="help-block">{{ $errors->first($name) }}</span>
    @elseif (isset($icon) && $icon)
        <div class="form-control-feedback">
            <i class={{ $icon }} text-muted"></i>
        </div>
    @endif
    @if (!isset($simple) || !$simple)
        <script>CKEDITOR.replace('{{ $name }}');</script>
    @endif
</div>
