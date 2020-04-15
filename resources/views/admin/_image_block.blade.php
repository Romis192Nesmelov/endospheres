<div class="{{ isset($mainClass) ? $mainClass : 'panel-body'}} edit-image-preview">
    @if (isset($data[$item]) && $data[$item] && $data[$item][$name])
        <a href="{{ isset($folder) ? asset('images/'.($folder ? $folder.'/' : '').$data[$item][$name]) : asset($data[$item][$name]) }}" class="img-preview" data-popup="lightbox"><img src="{{ isset($folder) ? asset('images/'.$folder.'/'.$data[$item][$name]).'?dummy='.md5(rand(0,10000)) : asset($data[$item][$name]) }}" /></a>
    @else
        <img {{ isset($height) ? 'height='.$height : '' }} src="{{ asset('images/placeholder.jpg') }}" />
    @endif
    @include('admin._input_file_block', ['label' => '', 'name' => $name])

    @if (!isset($title) || $title)
        @include('admin._input_block', [
            'name' => $name.'_title_'.App::getLocale(),
            'type' => 'text',
            'placeholder' => ($name == 'slide') ? trans('admin_content.tag_slide_title') : trans('admin_content.tag_image_title'),
            'value' => isset($data[$item]) ? $data[$item][$name.'_title_'.App::getLocale()] : ''
        ])
    @endif
</div>