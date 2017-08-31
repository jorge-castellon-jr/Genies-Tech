jQuery(document).ready(function ($) {
    var mySlider = $('.logo-carousel').slick({
        autoplay: false,
        autoplaySpeed: 5000,
        slidesToScroll: 1,
        slidesToShow: 4,
        infinite: true,
        prevArrow: '<a href="#" class="slick-prev"><div class="slick-icon-prev"></div></a>',
        nextArrow: '<a href="#" class="slick-next"><div class="slick-icon-next"></div></a>',
    });
});