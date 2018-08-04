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

function breakingAnim(startVal, endVal, object, attrName, unit, sign, breakingCoof)
{
    var i = startVal,
        sign = sign ? sign : 1,
        increment = endVal ? endVal / 60 : startVal / 60;

    var timer = setInterval(function() {
        i = i + increment * sign;
        if ((sign == 1 && i > endVal/3*2) || (sign == -1 && i < startVal/3)) increment = increment / breakingCoof;
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
    }, 3000);
}

function hideFooter() {
    var footer = $('#footer');
    footer.animate({
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

function loadVideo() {
    var id = 'video'+window.currentSlide;
    $('body').prepend('<div class="video-slide"><video id="'+id+'" muted="muted" preload="auto" loop="loop" preload="auto"><source src="'+window.slides[window.currentSlide].path+'" type="video/mp4"></video></div>');
    if (window.currentSlide && !window.slides[window.currentSlide-1].is_image) {
        var prevId = 'video'+(window.currentSlide-1);
        $('#'+prevId).parents('.video-slide').animate({
            'top':'-100%'
        }, 1000, function () {
            $(this).remove();
            showMouse();
        });
    }
    document.getElementById(id).play();
}

function removeVideo() {
    var videoContainer = $('.video-slide');
    if (videoContainer.length) videoContainer.remove();
}

function removeAllTruthFooter() {
    var secondFooter = $('#all-truth');
    if (secondFooter.length) secondFooter.remove();
}

function removeTimeout() {
    if (window.timeout) clearTimeout(window.timeout);
}

function digitMoving(useDecades=false) {
    var container = useDecades ? $('#ten-reasons-container .decades') : $('#ten-reasons-container .units'),
        count = useDecades ? Math.ceil(window.imagesCount / 10) : window.imagesCount,
        offset = 0,
        offsetCount = 1,
        unitCount = 1,
        digitMove = setInterval(function() {
            offset += 2.5;
            offsetCount++;

            if (offsetCount == 85) {
                offsetCount = 0;
                unitCount++;
            }

            if (unitCount == 9 && !useDecades) {
                digitMoving(true);
                unitCount = 1;
            }

            if (offset <= (170 * count)) container.css({'transform':'translateY('+ (offset * -1) +'px)'});
            else {
                clearInterval(digitMove);
                if (useDecades) showMouse();
            }
        }, 1);
}

function nextSlide() {
    hideMouse();
    hideFooter();
    removeTimeout();

    if (!window.currentSlide) {
        $('#background-image').animate({
            'opacity':0
        }, 500, function () {
            $('#all-truth').removeClass('hidden');
            showFooter();
            $('#ten-reasons-container').animate({
                'margin-left':0
            }, 500, function () {
                var self = $(this);
                var decades = Math.ceil(window.imagesCount / 10);

                if (decades > 0) {
                    for (var i=1;i<=decades;i++) {
                        self.find('.decades').append('<div>1</div>');
                    }
                }

                var val = 1;
                for (i=1;i<=window.imagesCount;i++) {
                    val = val != 10 ? val : 0;
                    self.find('.units').append('<div>' + val + '</div>');
                    val++;
                }
                digitMoving();
                // showMouse();
            })
        });
    } else if (window.currentSlide == 1 && !window.slides[window.currentSlide].is_image) {
        $('#ten-reasons-container').animate({'opacity':0}, 500, function () {
            $(this).remove();
            window.timeout = setTimeout(function(){
                nextSlide();
            },16000);
        });
    }

    if (!window.slides[window.currentSlide].is_image) loadVideo();
    else {
        removeAllTruthFooter();
        var decade = window.reasonsCount < 10 ? 0 : Math.ceil(window.reasonsCount / 10),
            unit = window.reasonsCount - decade,
            maskLinearSwg = $('#linear1-mask-svg'),
            maskInvertSwg = $('#invert1-mask-svg'),
            maskInvert = $('#invert1-mask'),
            decadesCont = maskLinearSwg.find('.decades'),
            unitsCont =  maskLinearSwg.find('.units'),
            reasonsFooter = $('#reasons'),
            imageSrc = window.slides[window.currentSlide].path;

        decadesCont.html(decade);
        unitsCont.html(unit);

        maskLinearSwg.find('image').attr('xlink:href',imageSrc);
        maskInvertSwg.find('image').attr('xlink:href',imageSrc);

        reasonsFooter.find('.slide-number.total').html(window.imagesCount);
        reasonsFooter.find('.slide-number.current').html(window.reasonsCount < 10 ? '0'+window.reasonsCount : window.reasonsCount);
        reasonsFooter.find('.text').html(window.slides[window.currentSlide].description);
        if (reasonsFooter.hasClass('hidden')) reasonsFooter.removeClass('hidden');

        $('#linear1-mask-svg ')

        var videoContainer = $('.video-slide'),
            background = videoContainer.length ? videoContainer : $('#background-image');

        background.animate({
            'opacity':0.5
        }, 500, function () {
            breakingAnim(0, 60, decadesCont, 'y', '%', 1, 1.05);

            setTimeout(function() {
                breakingAnim(0, 60, unitsCont, 'y', '%', 1, 1.05);
            }, 500);

            setTimeout(function() {
                breakingAnim(100, 0, maskInvert, 'y', '%', -1, 1.055);
            }, 2000);

            setTimeout(function() {
                removeVideo();
                showFooter();

                $('#background-image').attr('xlink:href',imageSrc);
                decadesCont.attr('y','0%');
                unitsCont.attr('y','0%');
                maskInvert.attr('y','100%');
            }, 2500);

        });
        window.reasonsCount++;
    }
    window.currentSlide++;
}