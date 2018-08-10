jQuery(document).ready(function ($) {
    $('#send_message').click(function(e) {
        e.preventDefault();

        var self = $(this);
        var container = self.parents('.container');
        var textarea = container.find('textarea');

        var fields = {};
        $.each(container.find('input.form-control'), function (key, obj) {
            fields[obj.name] = obj.value;
        });
        fields['message'] = textarea.val();
        fields['_token'] = $('input[name=_token]').val();
        $.post('/feedback', fields)
            .done(function( data ) {
                clearErrors(container);
                container.find('input').val('');
                textarea.val('');
                $('#message').modal('show');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                clearErrors(container);
                var responseMsg = jQuery.parseJSON(jqXHR.responseText);
                $.each(responseMsg, function (message, value) {
                    var errObj = message == 'message' ? textarea : container.find('input[name='+message+']');
                    var parent = errObj.parents('.form-group');
                    parent.addClass('has-error');
                    parent.find('.help-block').html(value);
                });
            });
    });
});

function clearErrors(container) {
    container.find('.form-group').removeClass('has-error');
    container.find('span.help-block').html('');
}