jQuery(document).ready(function ($) {
    $('#feedback_modal form button[type=submit]').click(function(e) {
        e.preventDefault();

        var self = $(this);
        var form = self.parents('form');
        var textarea = form.find('textarea');

        var fields = {};
        $.each(form.find('input.form-control'), function (key, obj) {
            fields[obj.name] = obj.value;
        });
        fields['feedback'] = textarea.val();
        fields['_token'] = form.find('input[name=_token]').val();
        $.post(form.attr('action'), fields)
            .done(function( data ) {
                $('#feedback_modal').modal('hide');
                $('#message').modal('show');
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                form.find('.form-group').removeClass('has-error');
                form.find('span.help-block').html('');

                var responseMsg = jQuery.parseJSON(jqXHR.responseText);
                $.each(responseMsg, function (message, value) {
                    var errObj = message == 'feedback' ? textarea : form.find('input[name='+message+']');
                    var parent = errObj.parents('.form-group');
                    parent.addClass('has-error');
                    parent.find('.help-block').html(value);
                });
            });
    });
});