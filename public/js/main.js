$(window).ready(function ($) {
    $('#slideshow').dm3Slideshow({
        speed: 500,
        autoScrollInterval: 4000,
        autoScroll: true
    });

    window.shadeMoving = false;
    setTimeout(function () {
        $('.href-image').each(function () {
            var logo = $('<img src="'+window.assetImages+'/sroface_logo.png" />').css('margin-top',($(this).height()/2-37));
            var shade = $('<div></div>').append(logo).addClass('shade').css({
                'width':$(this).width(),
                'height':$(this).height(),
                'margin-top':$(this).height()*(-1)
            });
            $(this).find('.image-frame').prepend(shade);
        }).hover(function () {
            $(this).find('.shade').animate({'margin-top':0});
        }, function () {
            $(this).find('.shade').animate({'margin-top':$(this).height()*(-1)});
        });
    }, 500);
});