window.changeSlidesMode = false;
$(window).ready(function ($) {
    $('html').animate({'opacity':1}, 500);

    window.audio = 'welcome';
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

function slideAnimation(startVal, endVal, object, callback) {
    // var i = startVal,
    //     sign = sign ? sign : 1,
    //     increment = 1;
    //
    // var timer = setInterval(function() {
    //     i = i + increment * sign;
    //     object.attr(attrName, (i + unit));
    //     if ((sign == 1 && i >= endVal) || (sign == -1 && i <= endVal)) {
    //         object.attr(attrName, endVal);
    //         clearInterval(timer);
    //         if (callback) callback();
    //     }
    // }, 0.5);

    object.css('MyY',object.attr('y')).animate({MyY:Math.abs(startVal-endVal)},{step:function(v1) {
        var position = startVal > endVal ? startVal-v1 : startVal+v1;
        object.attr('y',position+'%');
        if (position == endVal) {
            if (callback) callback();
        }
    }});
}

function hideMouse(newColor) {
    $(document).unbind();
    $('#mouse-container').animate({'opacity':0}, 500, function () {
        if (newColor) {
            $(this).css('color',newColor);
            $('#mouse').css('border-color',newColor);
            $('#mouse > div').css('background-color',newColor);
        }
    });
}

function showMouse() {
    var mouseContainer = $('#mouse-container');
    if (window.currentSlide == window.slides.length) {
        mouseContainer.remove();
        $('#button').removeClass('hidden').animate({
            'opacity':0.75
        });
    } else {
        if (!window.currentSlide) {
            window.mouseClickAnim = setInterval(function () {
                $('.icon-mouse-left').animate({'opacity': 0}, 1000, function () {
                    $(this).animate({'opacity': 1}, 1000);
                });
            }, 2000);

            setTimeout(function () {
                mouseContainer.animate({'opacity':1}, 500);
                $('#main-container').click(function () {
                    nextSlide();
                    $(this).unbind();
                });
            }, 1000);
        } else if (window.currentSlide == 1) {
            clearInterval(window.mouseClickAnim);
            $('#mouse-click-container').remove();

            $('#mouse-scroll-container').removeClass('hidden');
            $('#hrefs .glyphicon').removeClass('hidden').animate({'opacity':1}, 200, function () {
                // Bind mute icon
                $(this).click(function () {
                    if ($(this).hasClass('glyphicon-volume-off')) {
                        var removeClass = 'glyphicon-volume-off',
                            addClass = 'glyphicon-volume-up';
                        Cookies.set('muted', 1, { expires: 365 });
                        pause(window.audio);
                    } else {
                        removeClass = 'glyphicon-volume-up';
                        addClass = 'glyphicon-volume-off';
                        if (window.audio == 'welcome') playAudio();
                        else play(window.audio);
                        Cookies.remove('muted');
                    }
                    $(this).removeClass(removeClass).addClass(addClass);
                });
            });

            window.mouseClickAnim = setInterval(function () {
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

            setTimeout(function () {
                mouseContainer.animate({'opacity':1}, 500);
                mouseMoveBind();
            }, 1000);
        } else {
            clearInterval(window.mouseClickAnim);
            setTimeout(function () {
                mouseMoveBind();
            }, 700);
        }
    }
}

function mouseMoveBind() {
    window.changeSlidesMode = false;
    $(document).mousewheel(function () {
        nextSlide();
    }).click(function () {
        nextSlide();
    });
}

function hideFooter(currentSlide, reasonNumber) {
    var footer = $('#footer');
    footer.animate({
        'margin-bottom':-300,
        'opacity':0
    }, 1000, function () {
        if (window.slides[currentSlide].description) {
            var reasonsFooter = $('#reasons');
            reasonsFooter.find('.slide-number.total').html(window.imagesCount);
            reasonsFooter.find('.slide-number.current').html(reasonNumber < 10 ? '0'+reasonNumber : reasonNumber);
            reasonsFooter.find('.text').html('<div>'+window.slides[currentSlide].head+'</div>'+window.slides[currentSlide].description);
        }
    });
}

function showFooter() {
    $('#footer').animate({
        'margin-bottom':0,
        'opacity':1
    }, 1000);
}

function playAudio() {
    play(window.audio);
    setTimeout(function () {
        window.audio = 'music';
        play(window.audio);
    },4000);
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
    if (window.changeSlidesMode) return false;
    window.changeSlidesMode = true;
    var digits = $('#digits'),
        tenReasonsContainer = $('#ten-reasons-container'),
        currentSlide = window.currentSlide;

    if (digits.length) {
        digits.animate({
            'opacity':0
        }, 200, function () {
            $('#digits-mask-svg').remove();
        });
    }

    if (!currentSlide && !Cookies.get('muted')) playAudio();
    else if (currentSlide && tenReasonsContainer.length) {
        tenReasonsContainer.animate({'opacity':0}, 500, function () {
            $(this).remove();
        });
    }

    hideMouse(window.slides[currentSlide].mouse_color);
    hideFooter(currentSlide, window.reasonsCount);
    removeTimeout();

    var background = currentSlide && !window.slides[currentSlide-1].is_image ? $('#video-container-'+window.slides[currentSlide-1].id) : $('#background-image');
    $('body').css('background-color',window.slides[currentSlide].background_color);

    if (window.slides[currentSlide].is_image) {
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
            slideAnimation(0, 60, decadesCont);
            setTimeout(function() {
                slideAnimation(0, 60, unitsCont);
            }, 500);

            setTimeout(function() {
                slideAnimation(100, 0, maskInvert, function () {
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
                showFooter();
                tenReasonsContainer.animate({
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
    window.currentSlide++;
}