<?php $attrString = ''; ?>
@if (isset($addAttr) && is_array($addAttr))
    @foreach ($addAttr as $attr => $val)
        <?php $attrString .= $attr.'='.$val.' '; ?>
    @endforeach
@endif
<button {{ isset($id) ? 'id='.$id : '' }} {{ isset($disabled) && $disabled ? 'disabled' : '' }} type="{{ $type }}" {{ $attrString }} class="btn {{ isset($mainClass) ? $mainClass : 'bg-primary-400' }} {{ isset($addClass) ? $addClass : '' }}">
    @if (isset($icon))
        <span class="{{ $icon }}"></span>
    @endif
    {!! $text !!}
</button>