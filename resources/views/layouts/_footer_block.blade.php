<div id="footer">
    <div class="container">
        <div id="contacts" class="col-md-4 col-xs-12 col-sm-12">
            <img id="footer_image" class="hidden-sm hidden-xs" src="/images/bitcoin.png">
            <div>
                {{ trans('content.tel') }}: <a href="tel:+74955075579">+7 495 333-22-11</a><br>
                {{ trans('content.tel') }}: <a href="tel:+74955075257">+7 495 333-22-11</a><br>
                {!! trans('content.address') !!}
            </div>
        </div>

        <div class="col-md-8 footer_part hidden-xs hidden-sm">
            <div class="articles">
                <h3>{{ trans('content.recommended_articles') }}:</h3>
                @include('layouts._articles_links_block',['start' => 0, 'finish' => ceil(count($articles)/3)])
                @include('layouts._articles_links_block',['start' => ceil(count($articles)/3), 'finish' => (ceil(count($articles)/3))*2])
                @include('layouts._articles_links_block',['start' => (ceil(count($articles)/3))*2, 'finish' => count($articles)])
            </div>
        </div>
    </div>
</div>

<div id="copyright">
    <div class="container">
        © <a href="#">My Real Coin</a> — All rights reserved, 2018.
    </div>
</div>