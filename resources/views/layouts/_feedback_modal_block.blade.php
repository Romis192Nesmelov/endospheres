<?php ob_start(); ?>
<div class="feedback-container">
    <div class="modal-body">
        @include('_input_block',['name' => 'name', 'type' => 'text', 'placeholder' => trans('content.your_name'), 'icon' => 'icon-user', 'useAjax' => true])
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => trans('content.your_email'), 'icon' => 'icon-mail-read', 'useAjax' => true])
        @include('_input_block',['name' => 'phone', 'type' => 'text', 'placeholder' => trans('content.your_phone'), 'icon' => 'icon-iphone', 'useAjax' => true])
        <p class="description">{{ trans('content.feedback_limit') }}</p>
        @include('_textarea_block', ['name' => 'message', 'placeholder' => trans('content.message'), 'icon' => 'icon-bubble-dots4', 'simple' => true, 'useAjax' => true])
        @include('_checkbox_block', ['name' => 'i_agree', 'label' => trans('content.i_agree_pd'), 'checked' => false])
        <div style="padding: 10px; display: table;">
            @include('_policy_block')
        </div>
    </div>
    <div class="modal-footer">
        @include('_button_block', [
            'type' => 'submit',
            'text' => trans('content.send'),
            'disabled' => true
        ])
    </div>
</div>

<?php $content = ob_get_clean(); ?>
@include('layouts._modal_block',['id' => 'feedback_modal', 'title' => trans('content.send_request'), 'content' => $content, 'mainClass' => 'bg-primary-400', 'addClass' => isset($addClass) ? $addClass : null])