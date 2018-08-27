@if (isset($data['chapter']) && ($data['chapter']->id == 1 || $data['chapter']->id == 10))
    <div class="container">
        <h2>{{ trans('content.answer_question') }}</h2>
    </div>
    <div id="footer">
        {{ csrf_field() }}
        <div class="container feedback-container">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="title">{{ trans('content.feedback_form') }}</div>
                @include('_input_block',['name' => 'name', 'type' => 'text', 'placeholder' => trans('content.your_name'), 'icon' => 'icon-user', 'useAjax' => true])
                @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => trans('content.your_email'), 'icon' => 'icon-mail-read', 'useAjax' => true])
                @include('_input_block',['name' => 'phone', 'type' => 'text', 'placeholder' => trans('content.your_phone'), 'icon' => 'icon-iphone', 'useAjax' => true])
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="title">{{ trans('content.feedback_form') }}</div>
                @include('_textarea_block', ['name' => 'message', 'placeholder' => trans('content.message'), 'icon' => 'icon-bubble-dots4', 'simple' => true, 'useAjax' => true])
                @include('_button_block', ['type' => 'button', 'id' => 'send_message', 'text' => trans('content.send'), 'addClass' => 'pull-right', 'icon' => 'icon-upload'])
            </div>
        </div>
    </div>
@endif

@if (isset($data['chapter']))
    <div id="all-truth-about">
        <a href="/all-truth-about">
            <div class="container">
                <h2>{{ trans('content.all_truth_about') }}</h2>
            </div>
        </a>
    </div>
@endif

<div id="copyright-line">
    <div class="container">
        <div class="copyright hidden-xs">{{ trans('content.copyright') }}</div>
        <div class="soc-icon" style="margin-left: 20px;"><a href="#"><img src="{{ asset('images/vk.png') }}" /></a></div>
        <div class="soc-icon"><a href="#"><img src="{{ asset('images/youtube.png') }}" /></a></div>
        <div class="soc-icon"><a href="#"><img src="{{ asset('images/fb.png') }}" /></a></div>
        <div class="soc-icon"><a href="#"><img src="{{ asset('images/insta.png') }}" /></a></div>
    </div>
</div>