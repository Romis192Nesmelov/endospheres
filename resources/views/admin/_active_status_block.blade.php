<?php

if ($item->active) {
    $label = 'success';
    $status = trans('admin_content.active');
} else {
    $label = 'warning';
    $status = trans('admin_content.not_active');
}
?>

<span class="label label-{{ $label }}">{{ $status }}</span>