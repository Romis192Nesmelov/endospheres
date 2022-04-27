<?php ob_start(); ?>
<div class="modal-body">
    <h2>{{ trans('content.we_use_cookies') }}</h2>
</div>
<div class="modal-footer">
    @include('_button_block', ['type' => 'button', 'text' => trans('content.agree'), 'mainClass' => 'bg-primary-400', 'addAttr' => ['data-dismiss' => 'modal']])
</div>

@include('layouts._modal_block',[
    'id' => 'cookie_modal',
    'title' => trans('content.warning'),
    'content' => ob_get_clean(),
    'mainClass' => 'bg-primary-400',
    'addClass' => isset($addClass) ? $addClass : null
])

<script>
    jQuery(document).ready(function ($) {
        $('#cookie_modal').modal('show');
    });
</script>