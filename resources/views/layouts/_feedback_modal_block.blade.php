<?php ob_start(); ?>
<form class="form-horizontal" action="/feedback" method="post">
    {{ csrf_field() }}
    <div class="modal-body">
        @include('_input_block', [
            'name' => 'feedback_name',
            'type' => 'text',
            'placeholder' => trans('content.please_enter_your_name'),
            'icon' => 'icon-user',
            'useAjax' => true,
        ])

        @include('_input_block', [
            'name' => 'feedback_email',
            'type' => 'email',
            'placeholder' => trans('content.please_enter_your_email'),
            'icon' => 'icon-envelop4',
            'useAjax' => true,
        ])

        @include('_input_block', [
            'name' => 'feedback_phone',
            'type' => 'tel',
            'placeholder' => trans('content.please_enter_your_phone'),
            'icon' => 'icon-phone',
            'useAjax' => true,
        ])
        <p class="description">{{ trans('content.feedback_limit') }}</p>
        @include('_textarea_block', ['name' => 'feedback', 'addClass' => 'feedback', 'value' => '', 'simple' => true, 'useAjax' => true])
    </div>
    <div class="modal-footer">
        @include('admin._button_block', ['type' => 'submit', 'text' => trans('content.send')])
    </div>
</form>

<?php $content = ob_get_clean(); ?>
@include('layouts._modal_block',['id' => 'feedback_modal', 'title' => trans('content.send_request'), 'content' => $content, 'addClass' => isset($addClass) ? $addClass : null])