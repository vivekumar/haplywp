/*=====================================================================
    ==========================  Scroll-Preloader  =========================
    ========================================================================*/

var progressPath = document.querySelector('.progress-wrap path');
var pathLength = progressPath.getTotalLength();
progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
progressPath.style.strokeDashoffset = pathLength;
progressPath.getBoundingClientRect();
progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength / height);
    progressPath.style.strokeDashoffset = progress;
}
updateProgress();
$(window).scroll(updateProgress);
var offset = 50;
var duration = 0;
jQuery(window).on('scroll', function () {
    if (jQuery(this).scrollTop() > offset) {
        jQuery('.progress-wrap').addClass('active-progress');
    } else {
        jQuery('.progress-wrap').removeClass('active-progress');
    }
});
jQuery('.progress-wrap').on('click', function (event) {
    event.preventDefault();
    jQuery('html, body').animate({ scrollTop: 0 }, duration);
    return false;
})

// Preloader
var win = $(window);
win.on('load', function () {
    $('#pre-loader').delay(350).fadeOut('slow');
    $('body').delay(350).css({
        'overflow': 'visible'
    });
})

// if ($(window).width() > 991) {
//     new WOW().init();
// }

/*========================================================================================================
================================ Sticky header ===================================================================
===========================================================================================================*/



$(window).scroll(function () {
    var scroll = $(window).scrollTop();

    if (scroll > 80) {
        $('.header').addClass('sticky');
        $('.menu').addClass('menuSticky');
        $('.hwto-social').addClass('fixed-bottom');
    } else {
        $('.header').removeClass('sticky');
        $('.menu').removeClass('menuSticky');
    }
});

/*=====================================================================
    ==========================  ScrollToptoBottom  =========================
    ========================================================================*/

$(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
        $('#scroll').fadeIn();
    } else {
        $('#scroll').fadeOut();
    }
});
$('#scroll').click(function () {
    $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});




/*========================================================================================================
================================ slider-home owlCarousel ===================================================================
===========================================================================================================*/

$('.testimonial-carousel').owlCarousel({
    loop: true,
    responsiveClass: true,
    nav: true,
    margin: 0,
    autoplayTimeout: 4000,
    smartSpeed: 400,
    center: true,
    navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    responsive: {
        0: {
            items: 1,
        },
        600: {
            items: 5
        },
        1200: {
            items: 5
        }
    }
});

/*========================================================================================================
================================Tooltips ===================================================================
===========================================================================================================*/
if ($('.toltip').length) {



    $(".toltip").hover(
        function () {
            let show = $(this).parents("li").find('.toltipBx');
            console.log("Length: ", show.length);

            if (show.length > 0) {
                $(this).parents("li").addClass("oToltip");
            }
        },
        function () {
            $(this).parents("li").removeClass("oToltip");
        }
    );
}

$("#color_change p").click(function () {
    $("#color_change").toggleClass("show");
    $(this).find('i').toggleClass('fa-fill-drip fa-xmark')
})

$(".navbar-toggler").click(function () {
    $(this).find('i').toggleClass('fa-bars fa-xmark')
})
/*
$(".featureBtn").hover(function () {
    $(this).html(function (i, html) {
        return html.indexOf('Hide') !== -1 ? 'See all how-to articles' : 'Prøv vores demo';
    });
}, function () {
    $(this).html(function (i, html) {
        return html.indexOf('Hide') !== -1 ? 'Prøv vores demo' : 'See all how-to articles';
    });
})
*/
// themes color change
$("#color_change li").click(function () {
    var colorClass = $(this).attr("class");
    $("body[class^='bg-']").removeClass(function (index, className) {
        return (className.match(/\bbg-\S+/g) || []).join(' ');
    });
    $("body").removeClass("bg-white bg-green bg-red bg-blue bg-yellow").addClass(colorClass);
});




$(".showHeight").click(function () {
    $(".price-bx").toggleClass("customHeight");
    $(this).toggleClass("mt-4");

    $(this).html(function (i, html) {
        return html.indexOf('Hide') !== -1 ? 'Show more features' : 'Show less features';
    });
})






$('.about #search-category').keyup(function () {
    var search_term = $('#myInput').val();

    // alert(search_term);

    $('.highlight-text').removeHighlight().highlight(search_term);
    // $('#how_to_datafetch a').removeHighlight().highlight(search_term);
});


$('.about #search-category').keyup(function () {
    var search_term_1 = $('#how_to_datafetch a').val();
    $('#how_to_datafetch a').removeHighlight().highlight(search_term_1);
});







