jQuery(document).ready(function ($) {
    $('.order_offer').click(function () {
        $('#feedback_modal').modal('show');
    });

    $('input[name=i_agree]').change(function () {
        var self = $(this),
            container = self.parents('.feedback-container'),
            button = container.find('button');

        if (self.is(':checked')) button.removeAttr('disabled');
        else button.attr('disabled','disabled');
    });

    $('#send_message, #feedback_modal button').click(function(e) {
        e.preventDefault();

        var self = $(this),
            container = self.parents('.feedback-container'),
            textarea = container.find('textarea'),
            checkbox = container.find('input[name=i_agree]'),
            fields = {};

        if (checkbox.is(':checked')) {
            $.each(container.find('input.form-control, select.form-control'), function (key, obj) {
                fields[obj.name] = obj.value;
            });
            fields['message'] = textarea.val();
            fields['i_agree'] = checkbox.is(':checked');
            fields['_token'] = $('input[name=_token]').val();

            addLoaderScreen();

            $.post('/feedback', fields).done(function( data ) {
                clearErrors(container);
                container.find('input').val('');
                textarea.val('');
                $('#feedback_modal').modal('hide');
                removeLoaderScreen();
                $('#message').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                clearErrors(container);
                var responseMsg = jQuery.parseJSON(jqXHR.responseText);
                $.each(responseMsg, function (message, value) {
                    var errObj = message == 'message' ? textarea : container.find('input[name='+message+']');
                    var parent = errObj.parents('.form-group');
                    parent.addClass('has-error');
                    parent.find('.help-block').html(value);
                    removeLoaderScreen();
                });
            });
        }
    });
});

function clearErrors(container) {
    container.find('.form-group').removeClass('has-error');
    container.find('span.help-block').html('');
}

function addLoaderScreen() {
    $('body').css('overflow','hidden').append(
        $('<div></div>').attr('id','loader-screen').append(
            $('<img>').attr('src','../images/loader.gif')
        )
    );
}

function removeLoaderScreen() {
    $('body').css('overflow','auto');
    $('#loader-screen').remove();
}