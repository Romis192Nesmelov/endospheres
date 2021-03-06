<div class="modal-content">
    <!-- Заголовок модального окна -->
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">{!! isset($title) && $title ? $title : trans('content.warning') !!}</h4>
    </div>
    <!-- Основное содержимое модального окна -->
    @if (isset($message))
        <div class="modal-body"><h3>{!! $message !!}</h3></div>
        <!-- Футер модального окна -->
        <div class="modal-footer">
            @include('_button_block', ['type' => 'button', 'text' => trans('content.close'), 'mainClass' => 'bg-primary-400', 'addAttr' => ['data-dismiss' => 'modal']])
        </div>
    @elseif (isset($content))
        {!! $content !!}
    @endif
</div>