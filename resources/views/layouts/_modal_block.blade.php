<div id="{{ $id }}" class="modal fade {{ isset($addClass) && $addClass ? $addClass : '' }}">
    <div class="modal-dialog hidden-sm hidden-xs">
        @include('layouts._modal_content_block')
    </div>
    <div class="modal-mobile hidden-lg hidden-md">
        @include('layouts._modal_content_block')
    </div>
</div>