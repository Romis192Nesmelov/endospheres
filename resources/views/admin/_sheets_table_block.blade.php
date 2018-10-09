@if (count($data))
    <table class="table table-striped table-items">
        <tr>
            <th class="id">Id</th>
            <th width="20%" class="text-center">{{ trans('admin_content.head') }}</th>
            <th class="text-center">{{ trans('admin_content.content') }}</th>
            <th class="text-center">{{ trans('admin_content.status') }}</th>
            <th class="delete">{{ trans('admin_content.del') }}</th>
        </tr>
        @foreach ($data as $item)
            <tr role="row" id="{{ 'sheet_'.$item->id }}">
                <td class="id">{{ $item->id }}</td>
                <td class="text-center"><a href="/admin/{{ $suffix }}/?id={{ $item->id }}">{{ $item->head }}</a></td>
                <td class="text-left">@include('admin._substr_block', ['string' => strip_tags($item->content), 'length' => 500])</td>
                <td class="text-center">@include('admin._active_status_block', ['item' => $item])</td>
                <td class="delete"><span del-data="{{ $item->id }}" modal-data="delete-sheet-modal" class="glyphicon glyphicon-remove-circle"></span></td>
            </tr>
        @endforeach
    </table>
    @include('admin._add_button_block',['href' => $suffix.'/add', 'text' => trans('admin_content.add_'.$suffix)])
@else
    <h1>{{ trans('admin_content.no_content') }}</h1>
@endif