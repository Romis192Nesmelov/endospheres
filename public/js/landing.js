$(window).ready(function ($) {
    $('html').animate({'opacity':1}, 500);

    if (!Cookies.get('muted')) {
        setTimeout(function () {
            play('music');
        },2000);
    }

    // Bind mute icon
    $('#hrefs .glyphicon').click(function () {
        var audioId = 'music';
        if ($(this).hasClass('glyphicon-volume-off')) {
            var removeClass = 'glyphicon-volume-off',
                addClass = 'glyphicon-volume-up';
            Cookies.set('muted', 1, { expires: 365 });
            pause(audioId);
        } else {
            removeClass = 'glyphicon-volume-up';
            addClass = 'glyphicon-volume-off';
            play(audioId);
            Cookies.remove('muted');
        }
        $(this).removeClass(removeClass).addClass(addClass);
    });

    // Mouse wheel
    window.mouseAnim = setInterval(function () {
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

    // Digit flashes
    var digitsCoordinates = [{'x':773,'y':850},{'x':865,'y':870},{'x':958,'y':865},{'x':1045,'y':850},{'x':1118,'y':820},{'x':1185,'y':770},{'x':1231,'y':720},{'x':1270,'y':650},{'x':1300,'y':570},{'x':1318,'y':490}],
        digitsCounter = 0;
    window.digitFlashes = setInterval(function () {
        $('#digits-mask rect').attr({
            'x':digitsCoordinates[digitsCounter].x,
            'y':digitsCoordinates[digitsCounter].y
        });
        $('#digits').animate({'opacity':1}, 1000, function () {
            $(this).animate({'opacity':0}, 1000);
        });
    
        digitsCounter = digitsCounter == digitsCoordinates.length - 1 ? 0 : digitsCounter + 1;
    }, 2000);

    $('#mouse-container').css('opacity',0).removeClass('hidden');
    showMouse();
});

function breakingAnim(startVal, endVal, object, attrName, unit, sign, breakingCoof, callback)
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
            if (callback) callback();
        }
    }, 5);
}

function hideMouse(newColor) {
    $('#mouse-container').animate({'opacity':0}, 500, function () {
        if (newColor) {
            $(this).css('color',newColor);
            $('#mouse').css('border-color',newColor);
            $('#mouse > div').css('background-color',newColor);
        }
    });
    $(window).unbind();
}

function showMouse() {
    var mouseContainer = $('#mouse-container');
    if (window.currentSlide == window.slides.length) {
        clearInterval(window.mouseAnim);
        mouseContainer.remove();
        $('#button').removeClass('hidden').animate({
            'opacity':0.75
        });
    } else {
        setTimeout(function () {
            mouseContainer.animate({'opacity':1}, 500);
            $(window).mousewheel(function () { nextSlide(); });
        }, 2000);
    }
}

function hideFooter(currentSlide, reasonNumber) {
    var footer = $('#footer');
    footer.animate({
        'margin-bottom':-300,
        'opacity':0
    }, 1000, function () {
        if (window.slides[currentSlide].is_image) {
            var reasonsFooter = $('#reasons');
            reasonsFooter.find('.slide-number.total').html(window.imagesCount);
            reasonsFooter.find('.slide-number.current').html(reasonNumber < 10 ? '0'+reasonNumber : reasonNumber);
            reasonsFooter.find('.text').html('<div>'+window.slides[currentSlide].head+'</div>'+window.slides[currentSlide].description);
        } else $('#all-truth .text').html(window.slides[currentSlide].description);
    });
}

function showFooter() {
    $('#footer').animate({
        'margin-bottom':0,
        'opacity':1
    }, 1000);
}

function play(id) {
    var multimedia = document.getElementById(id);
    multimedia.muted = false;
    multimedia.play();
}

function pause(id) {
    document.getElementById(id).pause();
}

function removeVideo(currentSlide) {
    if (currentSlide && !window.slides[currentSlide-1].is_image) {
        $('#video-container-'+window.slides[currentSlide-1].id).remove();
    }
}

function removeAllTruthFooter() {
    var secondFooter = $('#all-truth');
    if (secondFooter.length) secondFooter.remove();
}

function removeTimeout() {
    if (window.timeout) clearTimeout(window.timeout);
    if (window.digitFlashes) clearInterval(window.digitFlashes);
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

            if (offset <= (200 * count)) container.css({'transform':'translateY('+ (offset * -1) +'px)'});
            else {
                clearInterval(digitMove);
            }
        }, 1);
}

function nextSlide() {
    var digits = $('#digits'),
        currentSlide = window.currentSlide;

    if (digits.length) {
        digits.animate({
            'opacity':0
        }, 200, function () {
            $('#digits-mask-svg').remove();
        });
    }

    hideMouse(window.slides[currentSlide].mouse_color);
    hideFooter(currentSlide, window.reasonsCount);
    removeTimeout();

    var background = currentSlide && !window.slides[currentSlide-1].is_image ? $('#video-container-'+window.slides[currentSlide-1].id) : $('#background-image');
    $('body').css('background-color',window.slides[currentSlide].background_color);

    if (window.slides[currentSlide].is_image) {
        removeAllTruthFooter();
        var decade = window.reasonsCount < 10 ? 0 : Math.ceil(window.reasonsCount / 10),
            unit = window.reasonsCount - (decade * 10),
            maskLinearSwg = $('#linear1-mask-svg'),
            maskInvertSwg = $('#invert1-mask-svg'),
            maskInvert = $('#invert1-mask'),
            decadesCont = maskLinearSwg.find('.decades'),
            unitsCont =  maskLinearSwg.find('.units'),
            imageSrc = window.slides[currentSlide].path;

        decadesCont.html(decade);
        unitsCont.html(unit);

        maskLinearSwg.find('image').attr('xlink:href',imageSrc);
        maskInvertSwg.find('image').attr('xlink:href',imageSrc);
        maskInvert.attr('y','100%');

        if ($('#reasons').hasClass('hidden')) $('#reasons').removeClass('hidden');

        background.animate({
            'opacity':0.35
        }, 500, function () {
            breakingAnim(0, 60, decadesCont, 'y', '%', 1, 1.05);
            setTimeout(function() {
                breakingAnim(0, 60, unitsCont, 'y', '%', 1, 1.05);
            }, 500);

            setTimeout(function() {
                breakingAnim(100, 0, maskInvert, 'y', '%', -1, 1.055, function () {
                    $('#background-image').attr('xlink:href',imageSrc).css('opacity',1);
                    decadesCont.attr('y','0%');
                    unitsCont.attr('y','0%');
                    removeVideo(currentSlide);
                    var logo = $('#logo');
                    if (logo.hasClass('hidden')) {
                        logo.css('opacity',0).removeClass('hidden');
                        logo.animate({'opacity':1},500);
                    }
                    showMouse();
                });
            }, 2000);

            setTimeout(function() {
                showFooter();
            }, 2500);
        });
        window.reasonsCount++;
    } else {
        background.animate({
            'opacity':0
        }, 500, function () {
            play('video-'+window.slides[currentSlide].id);
            showMouse();

            if (!currentSlide) {
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
                });
            }
        });
    }

    if (currentSlide || window.slides[currentSlide].is_image) {
        $('#ten-reasons-container').animate({'opacity':0}, 500, function () {
            // window.timeout = setTimeout(function(){
            //     nextSlide();
            // },16000);
        });
    }

    window.currentSlide++;
}