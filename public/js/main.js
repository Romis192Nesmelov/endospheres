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