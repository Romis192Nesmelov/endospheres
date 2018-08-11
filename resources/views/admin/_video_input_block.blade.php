<div class="panel panel-flat {{ isset($addClass) ? $addClass : '' }}">
    <div class="panel-body">
        @if (isset($video) && $video)
            {!! $video->url !!}
        @endif

        <div class="form-group has-feedback has-feedback-left">
            <label class="control-label col-md-1 col-sm-1 col-xs-12 text-semibold">{{ trans('admin_content.head') }}</label>
            <div class="col-md-11 col-sm-11 col-xs-12">
                <input name="video_head_ru[]" type="text" class="form-control" placeholder="{{ trans('admin_content.head') }}" value="{{ isset($video) && $video ? $video->head_ru : '' }}">
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <input style="padding-left: 45px;" name="video_url[]" type="text" class="form-control" placeholder="{{ trans('admin_content.video_url') }}" value="{{ isset($video) && $video ? $video->url : '' }}">
                <div class="form-control-feedback"><i class="icon-youtube3 text-muted"></i></div>
            </div>
        </div>
        <div class="clearfix form-group textarea has-feedback">
            <p class="description">{{ trans('admin_content.description') }}</p>
            <textarea class="simple" name="video_description_ru[]">{{ isset($video) && $video ? $video->description_ru : '' }}</textarea>
        </div>
    </div>
</div>