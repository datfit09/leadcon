(function ($) {
    'use strict';

	/**
	 * @param $scope The widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */
	var WidgetTestimonialHandler = function ($scope, $) {
        var type   = $scope.find('.testimonial-wrapper').attr('nav-type'),
            slide      = $scope.find('.js-testimonial'),
            $prevArrow , $nextArrow, $dot,
            show = $scope.find('.testimonial-wrapper').attr('data-show') || 3,
            showtablet = $scope.find('.testimonial-wrapper').attr('data-show-tablet') || show,
            showmobile = $scope.find('.testimonial-wrapper').attr('data-show-mobile') || show;

		if ( type === 'arrow' ) {
			$prevArrow =  $scope.find('.testimonial-prev-arrow');
			$nextArrow =  $scope.find('.testimonial-next-arrow');
			$dot = false;

		}else {
			$prevArrow = $('');
			$nextArrow = $('');
			$dot = true;
		}

		$(slide).slick({
			dots: $dot,
            slidesToShow: show,
			infinite: true,
            speed: 1000,
			adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 3000,
			prevArrow: $prevArrow,
			nextArrow: $nextArrow,
			appendDots: $scope.find(".testimonial-slider-dots"),
			customPaging: function (slider, i) {
				return '<span class="dots-bullet"></span>';
			},
            responsive: [
                {
                  breakpoint: 1622,
                  settings: {
                    slidesToShow: show,
                    slidesToScroll: 1,
                  }
                },
                {
                  breakpoint: 600,
                  settings: {
                    slidesToShow: showtablet,
                    slidesToScroll: 1,
                  }
                },
                {
                  breakpoint: 480,
                  settings: {
                    slidesToShow: showmobile,
                    slidesToScroll: 1,
                  }
                },
            ]
		});
	};

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/leadcon-testimonial.default', WidgetTestimonialHandler);
	});
})(jQuery);

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJlbGVtZW50b3IvdGVzdGltb25pYWwuanMiXSwic291cmNlc0NvbnRlbnQiOlsiKGZ1bmN0aW9uICgkKSB7XHJcbiAgICAndXNlIHN0cmljdCc7XHJcblxyXG5cdC8qKlxyXG5cdCAqIEBwYXJhbSAkc2NvcGUgVGhlIHdpZGdldCB3cmFwcGVyIGVsZW1lbnQgYXMgYSBqUXVlcnkgZWxlbWVudFxyXG5cdCAqIEBwYXJhbSAkIFRoZSBqUXVlcnkgYWxpYXNcclxuXHQgKi9cclxuXHR2YXIgV2lkZ2V0VGVzdGltb25pYWxIYW5kbGVyID0gZnVuY3Rpb24gKCRzY29wZSwgJCkge1xyXG4gICAgICAgIHZhciB0eXBlICAgPSAkc2NvcGUuZmluZCgnLnRlc3RpbW9uaWFsLXdyYXBwZXInKS5hdHRyKCduYXYtdHlwZScpLFxyXG4gICAgICAgICAgICBzbGlkZSAgICAgID0gJHNjb3BlLmZpbmQoJy5qcy10ZXN0aW1vbmlhbCcpLFxyXG4gICAgICAgICAgICAkcHJldkFycm93ICwgJG5leHRBcnJvdywgJGRvdCxcclxuICAgICAgICAgICAgc2hvdyA9ICRzY29wZS5maW5kKCcudGVzdGltb25pYWwtd3JhcHBlcicpLmF0dHIoJ2RhdGEtc2hvdycpIHx8IDMsXHJcbiAgICAgICAgICAgIHNob3d0YWJsZXQgPSAkc2NvcGUuZmluZCgnLnRlc3RpbW9uaWFsLXdyYXBwZXInKS5hdHRyKCdkYXRhLXNob3ctdGFibGV0JykgfHwgc2hvdyxcclxuICAgICAgICAgICAgc2hvd21vYmlsZSA9ICRzY29wZS5maW5kKCcudGVzdGltb25pYWwtd3JhcHBlcicpLmF0dHIoJ2RhdGEtc2hvdy1tb2JpbGUnKSB8fCBzaG93O1xyXG5cclxuXHRcdGlmICggdHlwZSA9PT0gJ2Fycm93JyApIHtcclxuXHRcdFx0JHByZXZBcnJvdyA9ICAkc2NvcGUuZmluZCgnLnRlc3RpbW9uaWFsLXByZXYtYXJyb3cnKTtcclxuXHRcdFx0JG5leHRBcnJvdyA9ICAkc2NvcGUuZmluZCgnLnRlc3RpbW9uaWFsLW5leHQtYXJyb3cnKTtcclxuXHRcdFx0JGRvdCA9IGZhbHNlO1xyXG5cclxuXHRcdH1lbHNlIHtcclxuXHRcdFx0JHByZXZBcnJvdyA9ICQoJycpO1xyXG5cdFx0XHQkbmV4dEFycm93ID0gJCgnJyk7XHJcblx0XHRcdCRkb3QgPSB0cnVlO1xyXG5cdFx0fVxyXG5cclxuXHRcdCQoc2xpZGUpLnNsaWNrKHtcclxuXHRcdFx0ZG90czogJGRvdCxcclxuICAgICAgICAgICAgc2xpZGVzVG9TaG93OiBzaG93LFxyXG5cdFx0XHRpbmZpbml0ZTogdHJ1ZSxcclxuICAgICAgICAgICAgc3BlZWQ6IDEwMDAsXHJcblx0XHRcdGFkYXB0aXZlSGVpZ2h0OiB0cnVlLFxyXG4gICAgICAgICAgICBhdXRvcGxheTogdHJ1ZSxcclxuICAgICAgICAgICAgYXV0b3BsYXlTcGVlZDogMzAwMCxcclxuXHRcdFx0cHJldkFycm93OiAkcHJldkFycm93LFxyXG5cdFx0XHRuZXh0QXJyb3c6ICRuZXh0QXJyb3csXHJcblx0XHRcdGFwcGVuZERvdHM6ICRzY29wZS5maW5kKFwiLnRlc3RpbW9uaWFsLXNsaWRlci1kb3RzXCIpLFxyXG5cdFx0XHRjdXN0b21QYWdpbmc6IGZ1bmN0aW9uIChzbGlkZXIsIGkpIHtcclxuXHRcdFx0XHRyZXR1cm4gJzxzcGFuIGNsYXNzPVwiZG90cy1idWxsZXRcIj48L3NwYW4+JztcclxuXHRcdFx0fSxcclxuICAgICAgICAgICAgcmVzcG9uc2l2ZTogW1xyXG4gICAgICAgICAgICAgICAge1xyXG4gICAgICAgICAgICAgICAgICBicmVha3BvaW50OiAxNjIyLFxyXG4gICAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogc2hvdyxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNjAwLFxyXG4gICAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogc2hvd3RhYmxldCxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgICAgYnJlYWtwb2ludDogNDgwLFxyXG4gICAgICAgICAgICAgICAgICBzZXR0aW5nczoge1xyXG4gICAgICAgICAgICAgICAgICAgIHNsaWRlc1RvU2hvdzogc2hvd21vYmlsZSxcclxuICAgICAgICAgICAgICAgICAgICBzbGlkZXNUb1Njcm9sbDogMSxcclxuICAgICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICAgICAgfSxcclxuICAgICAgICAgICAgXVxyXG5cdFx0fSk7XHJcblx0fTtcclxuXHJcblx0JCh3aW5kb3cpLm9uKCdlbGVtZW50b3IvZnJvbnRlbmQvaW5pdCcsIGZ1bmN0aW9uICgpIHtcclxuXHRcdGVsZW1lbnRvckZyb250ZW5kLmhvb2tzLmFkZEFjdGlvbignZnJvbnRlbmQvZWxlbWVudF9yZWFkeS9sZWFkY29uLXRlc3RpbW9uaWFsLmRlZmF1bHQnLCBXaWRnZXRUZXN0aW1vbmlhbEhhbmRsZXIpO1xyXG5cdH0pO1xyXG59KShqUXVlcnkpO1xyXG4iXSwiZmlsZSI6ImVsZW1lbnRvci90ZXN0aW1vbmlhbC5qcyJ9
