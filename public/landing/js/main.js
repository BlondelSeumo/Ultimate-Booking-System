jQuery(document).ready(function($){
    $('.st-testimonial-landing').each(function () {
        $(this).owlCarousel({
            loop: false,
            items: 1,
            margin: 30,
            responsiveClass: true,
            dots: false,
            nav: true,
            responsive: {
                0: {
                    items: 1,
                    margin: 15,
                },
                575: {
                    items: 1,
                    margin: 15,
                },
                992: {
                    items: 1,
                },
                1200: {
                    items: 1,
                }
            }
        });
    });


});

$(window).on('load', function(){
    $('.inner-scroll').marquee({
        //speed in milliseconds of the marquee
        duration: 25000,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: 'left',
        gap: 30,
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true,
        /*pauseOnHover: true,*/
        startVisible: true
    });
});

/*Scroll*/
jQuery(function($){
    ScrollReveal().reveal('.header .heading', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);

    ScrollReveal().reveal('.full-demo .text-heading', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.full-demo .demo-grid .col-lg-4', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);

    ScrollReveal().reveal('.demo-plugin h3', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.demo-plugin .demo-plugin-content .col-lg-6', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);

    ScrollReveal().reveal('.demo-theme-option .feature-theme-option .col-left', { origin: 'bottom', distance: '100px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.demo-theme-option .feature-theme-option .col-right', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.demo-theme-option .feature-services .col-left', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.demo-theme-option .feature-services .col-right', { origin: 'bottom', distance: '100px', duration: 1500, opacity: 0 }, 1500);

    ScrollReveal().reveal('.other-feature h3', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);
    ScrollReveal().reveal('.other-feature .other-content .col-lg-4', { origin: 'bottom', distance: '69px', duration: 1500, opacity: 0 }, 1500);

    ScrollReveal().reveal('.footer h3', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);
    ScrollReveal().reveal('.footer a', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);

    ScrollReveal().reveal('.testimonial', { origin: 'bottom', distance: '69px', duration: 750, opacity: 0 }, 750);

});



$(document).ready(function() {
    // grab the initial top offset of the navigation
    var stickyNavTop = 20;

    // our function that decides weather the navigation bar should have "fixed" css position or not.
    var stickyNav = function(){
        var scrollTop = $(window).scrollTop(); // our current vertical position from the top
        if (scrollTop >= stickyNavTop || scrollTop <= 26) {
            $('#main-menu').removeClass('sticky');
            $('.header').css({'padding-top' : '20px'});
        } else {
            $('#main-menu').addClass('sticky');
            $('.header').css({'padding-top' : '80px'});
        }
        stickyNavTop = scrollTop;
    };

    stickyNav();
    // and run it again every time you scroll
    $(window).scroll(function() {
        stickyNav();
    });

    $('.full-demo .demo-tab a').click(function (e) {
        e.preventDefault();
        $('.full-demo .demo-tab a').removeClass('active');
        $(this).addClass('active');

        var dataTab = $(this).data('tab');

        $('.demo-tab-wrapper .item-tab').removeClass('active');
        $('.demo-tab-wrapper .item-tab[data-tab="'+ dataTab +'"]').addClass('active');
    });
});