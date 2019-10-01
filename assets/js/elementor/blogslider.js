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

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJlbGVtZW50b3IvYmxvZ3NsaWRlci5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gKCQpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICAvKipcclxuICAgICAqIEBwYXJhbSAkc2NvcGUgVGhlIHdpZGdldCB3cmFwcGVyIGVsZW1lbnQgYXMgYSBqUXVlcnkgZWxlbWVudFxyXG4gICAgICogQHBhcmFtICQgVGhlIGpRdWVyeSBhbGlhc1xyXG4gICAgICovXHJcbiAgICB2YXIgV2lkZ2V0QmxvZ1NsaWRlckhhbmRsZXIgPSBmdW5jdGlvbiAoJHNjb3BlLCAkKSB7XHJcbiAgICAgICAgdmFyIHNsaWRlICAgICAgPSAkc2NvcGUuZmluZCgnLmpzLWJsb2ctc2xpZGVyJyk7XHJcblxyXG4gICAgICAgICQoc2xpZGUpLnNsaWNrKHtcclxuICAgICAgICAgICAgZG90czogdHJ1ZSxcclxuICAgICAgICAgICAgaW5maW5pdGU6IHRydWUsXHJcbiAgICAgICAgICAgIHNwZWVkOiAzMDAsXHJcbiAgICAgICAgICAgIGF1dG9wbGF5OiB0cnVlLFxyXG4gICAgICAgICAgICBhdXRvcGxheVNwZWVkOiAzMDAwLFxyXG4gICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxyXG4gICAgICAgICAgICBhcHBlbmREb3RzOiAkc2NvcGUuZmluZChcIi5ibG9nLXNsaWRlci1kb3RzXCIpLFxyXG4gICAgICAgICAgICBjdXN0b21QYWdpbmc6IGZ1bmN0aW9uIChzbGlkZXIsIGkpIHtcclxuICAgICAgICAgICAgICAgIHJldHVybiAnPHNwYW4gY2xhc3M9XCJkb3RzLWJ1bGxldFwiPjwvc3Bhbj4nO1xyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgIH0pO1xyXG4gICAgfTtcclxuXHJcbiAgICAkKHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbignZnJvbnRlbmQvZWxlbWVudF9yZWFkeS9sZWFkY29uLWJsb2ctc2xpZGVyLmRlZmF1bHQnLCBXaWRnZXRCbG9nU2xpZGVySGFuZGxlcik7XHJcbiAgICB9KTtcclxufSkoalF1ZXJ5KTtcclxuIl0sImZpbGUiOiJlbGVtZW50b3IvYmxvZ3NsaWRlci5qcyJ9
