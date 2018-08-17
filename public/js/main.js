$(window).ready(function ($) {
    $('#slideshow').dm3Slideshow({
        speed: 500,
        autoScrollInterval: 4000,
        autoScroll: true
    });

    window.shadeMoving = false;
    setTimeout(function () {
        $('.href-image').each(function () {
            addShade($(this),$(this).attr('data-logo'));
        });
    }, 500);
    
    $('a[data-video=1]').click(function (e) {
        e.preventDefault();
        var modal = $('#message');
        modal.find('.modal-header').html('<h3 class="text-center">'+$(this).html()+'</h3>');
        modal.find('.modal-body').html($(this).attr('href'));
        modal.on('hidden.bs.modal', function () {
            $(this).find('.modal-body').html('');
        });
        $('#message').modal('show');
    });

    $('li.question').click(function () {
        $('li.answer').hide();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('li.question').removeClass('active');
            $(this).addClass('active');
            var data = parseInt($(this).attr('data-question'));
            $('li.answer[data-answer='+data+']').fadeIn();
        }
    });
});

function addShade(obj, logo) {
    var shadeContainer = obj.find('.image-frame');
    var logoImg = $('<img src="'+window.assetImages+'/'+logo+'" />');
    var shade = $('<div></div>').append(logoImg).addClass('shade').css({
        'width':shadeContainer.width(),
        'height':shadeContainer.height(),
        'margin-top':shadeContainer.height()*(-1)
    });

    shadeContainer.prepend(shade);
    obj.hover(function () {
        $(this).find('.shade').animate({'margin-top':0});
    }, function () {
        $(this).find('.shade').animate({'margin-top':$(this).height()*(-1)});
    });
}