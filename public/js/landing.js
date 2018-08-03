$(document).ready(function ($) {
    // Mouse wheel
    var mWheel = setInterval(function () {
        $('#mouse > div').animate({
            'margin-top':25,
            'opacity':0
        }, 1000, function () {
            $(this).css({
                'margin-top':5,
                'opacity':1
            });
        });
    }, 2000);

    // $('#video').attr('autoplay','autoplay');

    $('#mouse-container').css('opacity',0).removeClass('hidden');
    showMouse();
});

function breakingAnim(startVal, endVal, object, attrName, unit, sign)
{
    var i = startVal,
        sign = sign ? sign : 1,
        increment = endVal ? endVal / 60 : startVal / 60;

    var timer = setInterval(function() {
        i = i + increment * sign;
        if ((sign == 1 && i > endVal/3*2) || (sign == -1 && i < startVal/3)) increment = increment / 1.05;
        increment = increment < 0.02 ? 0.02 : increment;
        object.attr(attrName, (i + unit));
        if ((sign == 1 && i > endVal) || (sign == -1 && i < endVal)) {
            i = endVal;
            clearInterval(timer);
        }
    }, 5);
}

function hideMouse() {
    $('#mouse-container').animate({'opacity':0}, 500);
    $(document).unbind();
}

function showMouse() {
    setTimeout(function () {
        $('#mouse-container').animate({'opacity':1}, 500);
        $(document).bind('mousewheel', function () { nextSlide(); });
    }, 2000);
}

function hideFooter() {
    $('#footer').animate({
        'margin-bottom':-300,
        'opacity':0
    });
}

function showFooter() {
    $('#footer').animate({
        'margin-bottom':0,
        'opacity':1
    });
}

function loadVideo(src, id) {
    $('body').prepend('<div class="video-slide"><video id="'+id+'" muted="muted" preload="auto" loop="loop" preload="auto"><source src="'+src+'" type="video/mp4"></video></div>');
    document.getElementById(id).play();
}

function removeVideo(id) {
    var container = $('#'+id).parents('.video-slide');
    container.remove();
}

function digitMoving(count, container, callBack) {
    var digit = 0;
    var digitMove = setInterval(function() {
        digit += 5;
        if (digit <= (170 * count)) {
            container.css({
                'transform':'translateY('+ (digit * -1) +'px)'
            });
        } else {
            clearInterval(digitMove);
            if (callBack) callBack();
        }
    }, 1);
}

function nextSlide() {
    hideMouse();
    if (!window.currentSlide) {
        loadVideo(window.slides[0].path, 'video1');
        $('#background-image').animate({
            'opacity':0
        }, 500, function () {
            showFooter();
            $('#ten-reasons-container').animate({
                'margin-left':0
            }, 500, function () {
                $(this).find('.decades').append('<div>1</div>');
                var self = $(this);
                for (var i=1;i<=10;i++) {
                    var val = i != 10 ? i : 0;
                    self.find('.units').append('<div>' + val + '</div>');
                }

                var callBack2 = function(){ showMouse(); };
                var callBack1 = function(){ digitMoving(1,self.find('.decades'),callBack2); };
                digitMoving(10,self.find('.units'),callBack1);
            })
        });
    }
}