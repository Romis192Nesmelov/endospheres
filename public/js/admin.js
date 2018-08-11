$(document).ready(function ($) {

    // Preview upload image
    $('input[type=file]').change(function () {
        var input = $(this)[0];
        var imagePreview = $(this).parents('.edit-image-preview').find('img');

        if (input.files[0].type.match('image.*')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            imagePreview.attr('src', '/images/placeholder.jpg');
        }
    });

    // Click to delete items
    $('.glyphicon-remove-circle').click(function () {
        deleteItem($(this));
    });

    // Click YES on delete modal
    $('.delete-yes').click(function () {
        $('#'+localStorage.getItem('delete_modal')).modal('hide');

        $.post('/admin/'+localStorage.getItem('delete_function'), {
            '_token': $('input[name=_token]').val(),
            'id': localStorage.getItem('delete_id'),
        }, function (data) {
            if (data.success) {
                var row = localStorage.getItem('delete_row');
                $('#'+row).remove();
            }
        });
    });

    // Click add video button
    $('#addVideo').click(function () {
        var inputs = $('.new-video');
        if (inputs.length == 1) $(this).remove();
        $(inputs[0]).removeClass('new-video');
    });
});

function deleteItem(obj) {
    var deleteModal = $('#'+obj.attr('modal-data'));

    localStorage.clear();
    localStorage.setItem('delete_id',obj.attr('del-data'));
    localStorage.setItem('delete_function',deleteModal.find('.modal-body').attr('del-function'));
    localStorage.setItem('delete_row', (obj.parents('tr').length ? obj.parents('tr').attr('id') : obj.parents('.col-lg-2').attr('id')));
    localStorage.setItem('delete_modal',obj.attr('modal-data'));

    deleteModal.modal('show');
}