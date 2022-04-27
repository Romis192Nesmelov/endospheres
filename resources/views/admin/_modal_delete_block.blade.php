<?php ob_start(); ?>
<div class="modal-body modal-delete" del-function="{{ $function }}" >
    <h3>{{ $head }}</h3>
</div>
<!-- Футер модального окна -->
<div class="modal-footer">
    @include('_button_block', ['type' => 'button', 'text' => trans('content.yes'), 'mainClass' => 'bg-primary-400', 'addClass' => 'delete-yes'])
    @include('_button_block', ['type' => 'button', 'text' => trans('content.no'), 'mainClass' => 'bg-primary-400', 'addAttr' => ['data-dismiss' => 'modal']])
</div>
@include('layouts._modal_block',['id' => $modalId, 'title' => trans('content.warning'), 'content' => ob_get_clean()])