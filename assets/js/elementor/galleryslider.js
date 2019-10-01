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

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJlbGVtZW50b3IvZ2FsbGVyeXNsaWRlci5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24gKCQpIHtcclxuICAgICd1c2Ugc3RyaWN0JztcclxuXHJcbiAgICAvKipcclxuICAgICAqIEBwYXJhbSAkc2NvcGUgVGhlIHdpZGdldCB3cmFwcGVyIGVsZW1lbnQgYXMgYSBqUXVlcnkgZWxlbWVudFxyXG4gICAgICogQHBhcmFtICQgVGhlIGpRdWVyeSBhbGlhc1xyXG4gICAgICovXHJcbiAgICB2YXIgV2lkZ2V0R2FsbGVyeVNsaWRlckhhbmRsZXIgPSBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgc2xpZGVyY291bnRlcignLmpzLWdhbGxlcnktc2xpZGVyJyk7XHJcbiAgICAgICAgLy8gc2xpY2sgc2xpZGVyIHdpdGggY291bnRcclxuICAgICAgICBmdW5jdGlvbiBzbGlkZXJjb3VudGVyKCRzbGlkZXIpe1xyXG4gICAgICAgICAgIGlmICgkKCRzbGlkZXIpLmxlbmd0aCkge1xyXG4gICAgICAgICAgICAgICB2YXIgY3VycmVudFNsaWRlO1xyXG4gICAgICAgICAgICAgICB2YXIgc2xpZGVzQ291bnQ7XHJcbiAgICAgICAgICAgICAgIHZhciB1cGRhdGVTbGlkZXJDb3VudGVyID0gZnVuY3Rpb24oc2xpY2ssIGN1cnJlbnRJbmRleCkge1xyXG4gICAgICAgICAgICAgICAgICAgY3VycmVudFNsaWRlID0gc2xpY2suc2xpY2tDdXJyZW50U2xpZGUoKSArIDE7XHJcbiAgICAgICAgICAgICAgICAgICBzbGlkZXNDb3VudCA9IHNsaWNrLnNsaWRlQ291bnQ7XHJcbiAgICAgICAgICAgICAgICAgICB2YXIgcmFuZ2VTdGVwICA9IDEwMC9zbGlkZXNDb3VudDtcclxuICAgICAgICAgICAgICAgICAgIC8vLyBkb3Qgd2lkdGhcclxuICAgICAgICAgICAgICAgICAgICQoJHNsaWRlcikuZmluZChcIi5zbGljay1kb3RzIGxpXCIpLmNzcyhcIndpZHRoXCIscmFuZ2VTdGVwK1wiJSBcIik7XHJcbiAgICAgICAgICAgICAgICAgICAkKFwiLmdhbGxlcnktY29udHJvbC1jb3VudGVyLWN1cnJlbnRcIikudGV4dChjdXJyZW50U2xpZGUpO1xyXG4gICAgICAgICAgICAgICAgICAgJChcIi5nYWxsZXJ5LWNvbnRyb2wtY291bnRlci10b3RhbFwiKS50ZXh0KHNsaWRlc0NvdW50KTtcclxuICAgICAgICAgICAgICAgfTtcclxuICAgICAgICAgICAgICAgJCgkc2xpZGVyKS5vbignaW5pdCcsIGZ1bmN0aW9uKGV2ZW50LCBzbGljaykge1xyXG4gICAgICAgICAgICAgICAgICAgLy8gJCgkc2xpZGVyKS5hcHBlbmQoc2xpZGVyQ291bnRlcik7XHJcbiAgICAgICAgICAgICAgICAgICB1cGRhdGVTbGlkZXJDb3VudGVyKHNsaWNrKTtcclxuICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICQoJHNsaWRlcikub24oJ2FmdGVyQ2hhbmdlJywgZnVuY3Rpb24oZXZlbnQsIHNsaWNrLCBjdXJyZW50U2xpZGUpIHtcclxuICAgICAgICAgICAgICAgICAgIHVwZGF0ZVNsaWRlckNvdW50ZXIoc2xpY2ssIGN1cnJlbnRTbGlkZSk7XHJcbiAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgICAgICAkKCRzbGlkZXIpLnNsaWNrKHtcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Nob3c6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICAgICAgICAgICAgICAgICAgZG90czp0cnVlLFxyXG4gICAgICAgICAgICAgICAgICAgIG5leHRBcnJvdzogZmFsc2UsXHJcbiAgICAgICAgICAgICAgICAgICAgYXV0b3BsYXk6IHRydWUsXHJcbiAgICAgICAgICAgICAgICAgICAgYXV0b3BsYXlTcGVlZDogMzAwMFxyXG4gICAgICAgICAgICAgICB9KTtcclxuICAgICAgICAgICAgICAgJCgnLmdhbGxlcnktc2xpZGVyLW5leHQtYXJyb3cnKS5vbignY2xpY2snLCBmdW5jdGlvbigpe1xyXG4gICAgICAgICAgICAgICAgICAgJCgkc2xpZGVyKS5zbGljayhcInNsaWNrTmV4dFwiKTtcclxuICAgICAgICAgICAgICAgfSk7XHJcbiAgICAgICAgICAgICAgICQoJy5nYWxsZXJ5LXNsaWRlci1wcmV2LWFycm93Jykub24oJ2NsaWNrJywgZnVuY3Rpb24oKXtcclxuICAgICAgICAgICAgICAgICAgICQoJHNsaWRlcikuc2xpY2soXCJzbGlja1ByZXZcIik7XHJcbiAgICAgICAgICAgICAgIH0pO1xyXG4gICAgICAgICAgIH1cclxuICAgICAgICB9O1xyXG4gICAgfTtcclxuXHJcbiAgICAkKHdpbmRvdykub24oJ2VsZW1lbnRvci9mcm9udGVuZC9pbml0JywgZnVuY3Rpb24gKCkge1xyXG4gICAgICAgIGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbignZnJvbnRlbmQvZWxlbWVudF9yZWFkeS9sZWFkY29uLWdhbGxlcnktc2xpZGVyLmRlZmF1bHQnLCBXaWRnZXRHYWxsZXJ5U2xpZGVySGFuZGxlcik7XHJcbiAgICB9KTtcclxufSkoalF1ZXJ5KTtcclxuIl0sImZpbGUiOiJlbGVtZW50b3IvZ2FsbGVyeXNsaWRlci5qcyJ9
