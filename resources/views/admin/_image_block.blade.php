<div class="{{ isset($mainClass) ? $mainClass : 'panel-body'}} edit-image-preview">
    @if (isset($data[$item]))
        <a href="{{ isset($folder) ? asset('images/'.($folder ? $folder.'/' : '').$data[$item][$name]) : asset($data[$name]->path) }}" class="img-preview" data-popup="lightbox"><img src="{{ isset($folder) ? asset('images/'.$folder.'/'.$data[$item][$name]).'?dummy='.md5(rand(0,10000)) : asset($data[$name]->path) }}" /></a>
    @else
        <img {{ isset($height) ? 'height='.$height : '' }} src="{{ asset('images/placeholder.jpg') }}" />
    @endif
    @include('admin._input_file_block', ['label' => '', 'name' => $name])
</div>