@include('layouts._modal_block',['id' => 'message', 'message' => (Session::has('message') ? Session::get('message') : trans('content.thanks_for_your_message'))])
@if (Session::has('message'))
    <script>$('#message').modal('show');</script>
@endif