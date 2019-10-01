(function ($) {
    'use strict';

    /**
     * @param $scope The widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetGallerySliderHandler = function () {
        slidercounter('.js-gallery-slider');
        // slick slider with count
        function slidercounter($slider){
           if ($($slider).length) {
               var currentSlide;
               var slidesCount;
               var updateSliderCounter = function(slick, currentIndex) {
                   currentSlide = slick.slickCurrentSlide() + 1;
                   slidesCount = slick.slideCount;
                   var rangeStep  = 100/slidesCount;
                   /// dot width
                   $($slider).find(".slick-dots li").css("width",rangeStep+"% ");
                   $(".gallery-control-counter-current").text(currentSlide);
                   $(".gallery-control-counter-total").text(slidesCount);
               };
               $($slider).on('init', function(event, slick) {
                   // $($slider).append(sliderCounter);
                   updateSliderCounter(slick);
               });
               $($slider).on('afterChange', function(event, slick, currentSlide) {
                   updateSliderCounter(slick, currentSlide);
               });
               $($slider).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots:true,
                    nextArrow: false,
                    autoplay: true,
                    autoplaySpeed: 3000
               });
               $('.gallery-slider-next-arrow').on('click', function(){
                   $($slider).slick("slickNext");
               });
               $('.gallery-slider-prev-arrow').on('click', function(){
                   $($slider).slick("slickPrev");
               });
           }
        };
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/leadcon-gallery-slider.default', WidgetGallerySliderHandler);
    });
})(jQuery);
