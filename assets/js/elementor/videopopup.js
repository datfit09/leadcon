(function ($) {
    'use strict';
    /**
     * @param $scope The widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetVideoPopupHandler = function ($scope, $) {
        var html5lightbox_options = {
            watermark: "http://html5box.com/images/html5boxlogo.png",
            watermarklink: "http://html5box.com"
        };
    };

    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/leadcon-video-popup.default', WidgetVideoPopupHandler);
    });
})(jQuery);
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJlbGVtZW50b3IvdmlkZW9wb3B1cC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gKCQpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuICAgIC8qKlxyXG4gICAgICogQHBhcmFtICRzY29wZSBUaGUgd2lkZ2V0IHdyYXBwZXIgZWxlbWVudCBhcyBhIGpRdWVyeSBlbGVtZW50XHJcbiAgICAgKiBAcGFyYW0gJCBUaGUgalF1ZXJ5IGFsaWFzXHJcbiAgICAgKi9cclxuICAgIHZhciBXaWRnZXRWaWRlb1BvcHVwSGFuZGxlciA9IGZ1bmN0aW9uICgkc2NvcGUsICQpIHtcclxuICAgICAgICB2YXIgaHRtbDVsaWdodGJveF9vcHRpb25zID0ge1xyXG4gICAgICAgICAgICB3YXRlcm1hcms6IFwiaHR0cDovL2h0bWw1Ym94LmNvbS9pbWFnZXMvaHRtbDVib3hsb2dvLnBuZ1wiLFxyXG4gICAgICAgICAgICB3YXRlcm1hcmtsaW5rOiBcImh0dHA6Ly9odG1sNWJveC5jb21cIlxyXG4gICAgICAgIH07XHJcbiAgICB9O1xyXG5cclxuICAgICQod2luZG93KS5vbignZWxlbWVudG9yL2Zyb250ZW5kL2luaXQnLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgZWxlbWVudG9yRnJvbnRlbmQuaG9va3MuYWRkQWN0aW9uKCdmcm9udGVuZC9lbGVtZW50X3JlYWR5L2xlYWRjb24tdmlkZW8tcG9wdXAuZGVmYXVsdCcsIFdpZGdldFZpZGVvUG9wdXBIYW5kbGVyKTtcclxuICAgIH0pO1xyXG59KShqUXVlcnkpOyJdLCJmaWxlIjoiZWxlbWVudG9yL3ZpZGVvcG9wdXAuanMifQ==
