jQuery(function($) {
    
    /* -----------------------------------------
    Preloader
    ----------------------------------------- */
    $('#preloader').delay(1000).fadeOut();
    $('#loader').delay(1000).fadeOut("slow");

    /* -----------------------------------------
    Marquee
    ----------------------------------------- */
    $(document).ready(function(){
        $("ul#newstick").endlessRiver({
            speed: 100
        });
    });

    /* -----------------------------------------
    Banner Section
    ----------------------------------------- */
    $('.banner-section-wrapper').slick({
        autoplay: false,
        autoplaySpeed: 3000,
        dots: true,
        arrows: true,
        adaptiveHeight: true,
        slidesToShow: 1,
        nextArrow: '<button class="adore-arrow slide-next fas fa-angle-right"></button>',
        prevArrow: '<button class="adore-arrow slide-prev fas fa-angle-left"></button>',
        responsive: [
        {
            breakpoint: 600,
            settings: {
                arrows: false,
            }
        }
        ]
    });

    /*--------------------------------------------------------------
    # Navigation menu responsive
    --------------------------------------------------------------*/
    $(document).ready(function(){
        $(".menu-toggle").click(function(){
            $(".main-navigation .nav-menu").slideToggle("slow");
        });
    });
    $(window).on('load resize', function() {
        if ($(window).width() < 1200) {
            $('.main-navigation').find("li").last().bind('keydown', function(e) {
                if (e.which === 9) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
        } else {
            $('.main-navigation').find("li").unbind('keydown');
        }
    });

    var primary_menu_toggle = $('#masthead .menu-toggle');
    primary_menu_toggle.on('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        var shiftKey = e.shiftKey;

        if (primary_menu_toggle.hasClass('open')) {
            if (shiftKey && tabKey) {
                e.preventDefault();
                $('.main-navigation').toggleClass('toggled');
                primary_menu_toggle.removeClass('open');
            };
        }
    });

    /*--------------------------------------------------------------
    # Navigation Search
    --------------------------------------------------------------*/
    var searchWrap = $('.navigation-search-wrap');
    $(".navigation-search-icon").click(function(e) {
        e.preventDefault();
        searchWrap.toggleClass("show");
        searchWrap.find('input.search-field').focus();
    });
    $(document).click(function(e) {
        if (!searchWrap.is(e.target) && !searchWrap.has(e.target).length) {
            $(".navigation-search-wrap").removeClass("show");
        }
    });

    $('.navigation-search-wrap').find(".search-submit").bind('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        if (tabKey) {
            e.preventDefault();
            $('.navigation-search-icon').focus();
        }
    });

    $('.navigation-search-icon').on('keydown', function(e) {
        var tabKey = e.keyCode === 9;
        var shiftKey = e.shiftKey;
        if ($('.navigation-search-wrap').hasClass('show')) {
            if (shiftKey && tabKey) {
                e.preventDefault();
                $('.navigation-search-wrap').removeClass('show');
                $('.navigation-search-icon').focus();
            }
        }
    });

    /* -----------------------------------------
    Scroll Top
    ----------------------------------------- */
    var scrollToTopBtn = $('.terminal-blog-scroll-to-top');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 400) {
            scrollToTopBtn.addClass('show');
        } else {
            scrollToTopBtn.removeClass('show');
        }
    });

    scrollToTopBtn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });

});