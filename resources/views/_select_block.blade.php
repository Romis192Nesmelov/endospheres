<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <label class="control-label col-md-12 text-semibold">{{ $label }}</label>
    @endif
        <select name="{{ $name }}" class="form-control">
            @foreach ($values as $value)
                <option value="{{ is_array($values) ? $value : $value->id }}" {{ ((is_array($values) && $value == $selected) || (isset($value->id) && $value->id == $selected) ) ? 'selected' : '' }}>{{ is_array($values) ? $value : $value[(isset($head) && $head ? $head : 'name')] }}</option>
            @endforeach
        </select>

        @if ($errors && $errors->has($name))
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block">{{ $errors->first($name) }}</span>
        @endif
</div>