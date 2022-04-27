<table class="table table-striped table-items">
    <tr>
        <th class="image text-center">{{ trans('admin_content.'.$fileName) }}</th>
        <th class="delete">{{ $data['device'][$fileName] ? trans('admin_content.del') : '' }}</th>
    </tr>
    @if ($data['device'][$fileName])
        <tr role="row" id="{{ 'device_'.$data['device']->id }}">
            <td class="text-left"><a href="{{ $data['device'][$fileName] }}" target="_blank"><i class="icon-file-pdf"></i> {{ pathinfo($data['device'][$fileName])['basename'] }}</a></td>
            <td class="delete">
                @if ($data['device'][$fileName])
                    <span del-data="{{ $data['device']->id }}" modal-data="delete-file-modal" class="glyphicon glyphicon-remove-circle"></span>
                @endif
            </td>
        </tr>
    @endif
    <tr role="row">
        <td colspan="2" class="text-center">@include('admin._input_file_block', ['name' => $fileName])</td>
    </tr>
</table>