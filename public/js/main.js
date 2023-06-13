$(window).ready(function ($) {
    $('#slideshow').dm3Slideshow({
        speed: 500,
        autoScrollInterval: 4000,
        autoScroll: true
    });

    setTimeout(function () {
        $('.href-image').each(function () {
            addHrefImageShade($(this),$(this).attr('data-logo'));
        });

        $('.mm-cover').each(function () {
            addCoverShade($(this));
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

    $('ul.hrefs li.head').click(function () {
        $('ul.hrefs li.content').hide();
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('ul.hrefs li.head').removeClass('active');
            $(this).addClass('active');
            var data = parseInt($(this).attr('data-head'));
            $('ul.hrefs li.content[data-content='+data+']').fadeIn();
        }
    });

    $('.photo-result').hover(function () {
        var width = $(this).width(),
            image = $(this).find('img'),
            marginLeft = width/4*(-1),
            head = $(this).find('a').attr('data-head'),
            descript = $(this).find('a').attr('data-description'),
            description = $('<div class="descript"><h6>'+head+'</h6>'+descript+'</div>');

        $(this).css('width',width);
        image.css({
            'height':250,
            'position':'absolute',
            'z-index': 999,
            'border': '3px solid white',
            'margin-left':marginLeft,
            'margin-top':-22,
            'box-shadow':'2px 2px 10px rgba(0,0,0,0.2)'
        });

        $(this).find('a').append(description.css({
            'width':image.width()+6,
            'margin-left':marginLeft
        }));
    }, function () {
        $(this).find('img').css({
            'height':'100%',
            'position':'relative',
            'z-index': 1,
            'border': 'none',
            'margin-left':0,
            'margin-top':0,
            'box-shadow':'none'
        });
        $(this).find('.descript').remove();
    });
    
    $('ul.truth-menu li a').click(function () {
        $('ul.truth-menu li').removeClass('active');
        $(this).parents('li').addClass('active');
    });


    // On-top button controls
    $(window).scroll(function() {
        var button = $('#on_top_button');
        if ($(this).scrollTop() > $(this).outerHeight()) button.fadeIn();
        else button.fadeOut();

        allFuckingTruth();
    });

    $('#on_top_button').click(function() {
        $(window).scrollTop(0);
    });

    $(window).resize(function () {
        allFuckingTruth();
    });
    allFuckingTruth();

    // Get search
    var findForm = $('#search-form');
    findForm.find('button').click(function (e) {
        e.preventDefault();
        location.href = '/search/'+findForm.find('input').val();
    });


});

function allFuckingTruth() {
    var allTruthSimple = $('#all-truth-about'),
        allTruthFixed = $('#all-truth-about-fixed');

    if (allTruthSimple.length) {
        if ($(document).scrollTop()+$(window).height() < allTruthSimple.offset().top+allTruthSimple.height()) {
            allTruthFixed.show();
        } else {
            allTruthFixed.hide();
        }
    }
}

function addHrefImageShade(obj, logo) {
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

function addCoverShade(obj) {
    var href = obj.find('a'),
        shade = $('<div></div>').addClass('shade').css({
        'width':obj.width(),
        'height':obj.height(),
        'margin-top':obj.height()*(-1)
    }).append($('<div></div>').html(href.attr('data-description')));

    href.prepend(shade);
    obj.hover(function () {
        $(this).find('.shade').animate({'margin-top':0});
    }, function () {
        $(this).find('.shade').animate({'margin-top':$(this).height()*(-1)});
    });
}