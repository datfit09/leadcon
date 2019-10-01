(function ($) {
    'use strict';

    /**
     * @param $scope The widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetBlogSliderHandler = function ($scope, $) {
        var slide      = $scope.find('.js-blog-slider');

        $(slide).slick({
            dots: true,
            infinite: true,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            appendDots: $scope.find(".blog-slider-dots"),
            customPaging: function (slider, i) {
                return '<span class="dots-bullet"></span>';
            },
        });
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/leadcon-blog-slider.default', WidgetBlogSliderHandler);
    });
})(jQuery);
