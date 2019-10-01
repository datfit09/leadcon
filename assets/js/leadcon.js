'use strict';

(function ($) {

	'use strict';
/* WHEN CLICK CART ITEM */
	$( '.cart-contents' ).on( 'click', function ( e ) {
		e.preventDefault();
		$( '#shop-cart-sidebar' ).addClass( 'showcart' );
		$( '#shop-overlay' ).addClass( 'show' );
			$('#close-cart-sidebar').on('click', function (e) {
			$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
			$( '#shop-overlay' ).removeClass( 'show' );
		});

		$('#shop-overlay').on('click', function (e) {
			$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
			$( this ).removeClass( 'show' );
		});
	} );

/* Photo Gallery Slider */
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        prevArrow: $('.button-single-prev'),
        nextArrow: $('.button-single-next'),
        useTransform: false,
        mobileFirst: true,

    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        asNavFor: '.slider-for',
        draggable: false,
        useTransform: false,
        mobileFirst: true,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    vertical: true,
                }
            },
            {
                breakpoint: 360,
                settings: {
                    vertical: false,
                }
            },
        ]

    });

/* MOBILE MENU */

	$( 'ul >.menu-item-has-children>a' ).on( 'click', function (e) {
		e.preventDefault();
		$( this ).parent().find( 'ul.sub-menu' ).toggle();
	} );

/* STICKY MENU */
	$(window).scroll(function() {
		if ( $(window).scrollTop() > 50 ) {

			$( '#sticky-menu' ).addClass( 'show-sticky' );
		}
		else {
			$( '#sticky-menu' ).removeClass('show-sticky');
		}
	} );

/* Loader */
	$(window).load(function() {
		$(".loader_boostify").delay(0).fadeOut("slow");
		$("#overlayer").delay(0).fadeOut("slow");
	} );

/* Swatch List */

	$( '.pro-swatch-list' ).on( 'click', '.p-attr-swatch', function(){
		var img_src = void 0;
		var src = $(this).attr( 'data-src' );
		var img_wrap = $(this).parents('li.product').find('.product-image-wrapper');
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');
		var img = img_wrap.find('img.product-thumb');

		if ( src == img_src ) {
			return;
		}

		img_wrap.addClass('image-is-loading');
		img.attr('src', src);
		img.attr('srcset', src).one('load', function () {
			return img_wrap.removeClass('image-is-loading');
		});
	});

	$( '.cat-parent' ).append( '<span class="ion-android-add cat-toggle"></span>' );
	$( '.cat-parent' ).addClass('disable');

	$( '.cat-parent' ).on( 'click', function (argument) {
		var cat = $(this),
			btn = $(this).find('.cat-toggle'),
			children = $(this).find('.children');
		if ( cat.hasClass('active') ) {
			cat.removeClass( 'active' ).addClass('disable');
			children.removeClass('children-active');
			btn.removeClass('ion-android-remove').addClass('ion-android-add');
		}
		else {
			cat.addClass('active').removeClass('disable');
			children.addClass('children-active');
			btn.removeClass('ion-android-add').addClass('ion-android-remove');
		}

	} );



})(jQuery);

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJsZWFkY29uLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIid1c2Ugc3RyaWN0JztcclxuXHJcbihmdW5jdGlvbiAoJCkge1xyXG5cclxuXHQndXNlIHN0cmljdCc7XHJcbi8qIFdIRU4gQ0xJQ0sgQ0FSVCBJVEVNICovXHJcblx0JCggJy5jYXJ0LWNvbnRlbnRzJyApLm9uKCAnY2xpY2snLCBmdW5jdGlvbiAoIGUgKSB7XHJcblx0XHRlLnByZXZlbnREZWZhdWx0KCk7XHJcblx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmFkZENsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHQkKCAnI3Nob3Atb3ZlcmxheScgKS5hZGRDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdCQoJyNjbG9zZS1jYXJ0LXNpZGViYXInKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdCQoICcjc2hvcC1vdmVybGF5JyApLnJlbW92ZUNsYXNzKCAnc2hvdycgKTtcclxuXHRcdH0pO1xyXG5cclxuXHRcdCQoJyNzaG9wLW92ZXJsYXknKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdCQoIHRoaXMgKS5yZW1vdmVDbGFzcyggJ3Nob3cnICk7XHJcblx0XHR9KTtcclxuXHR9ICk7XHJcblxyXG4vKiBQaG90byBHYWxsZXJ5IFNsaWRlciAqL1xyXG4gICAgJCgnLnNsaWRlci1mb3InKS5zbGljayh7XHJcbiAgICAgICAgc2xpZGVzVG9TaG93OiAxLFxyXG4gICAgICAgIHNsaWRlc1RvU2Nyb2xsOiAxLFxyXG4gICAgICAgIHByZXZBcnJvdzogJCgnLmJ1dHRvbi1zaW5nbGUtcHJldicpLFxyXG4gICAgICAgIG5leHRBcnJvdzogJCgnLmJ1dHRvbi1zaW5nbGUtbmV4dCcpLFxyXG4gICAgICAgIHVzZVRyYW5zZm9ybTogZmFsc2UsXHJcbiAgICAgICAgbW9iaWxlRmlyc3Q6IHRydWUsXHJcblxyXG4gICAgfSk7XHJcbiAgICAkKCcuc2xpZGVyLW5hdicpLnNsaWNrKHtcclxuICAgICAgICBzbGlkZXNUb1Nob3c6IDQsXHJcbiAgICAgICAgc2xpZGVzVG9TY3JvbGw6IDEsXHJcbiAgICAgICAgZG90czogZmFsc2UsXHJcbiAgICAgICAgY2VudGVyTW9kZTogdHJ1ZSxcclxuICAgICAgICBmb2N1c09uU2VsZWN0OiB0cnVlLFxyXG4gICAgICAgIGFzTmF2Rm9yOiAnLnNsaWRlci1mb3InLFxyXG4gICAgICAgIGRyYWdnYWJsZTogZmFsc2UsXHJcbiAgICAgICAgdXNlVHJhbnNmb3JtOiBmYWxzZSxcclxuICAgICAgICBtb2JpbGVGaXJzdDogdHJ1ZSxcclxuICAgICAgICByZXNwb25zaXZlOiBbXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDk5MixcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgdmVydGljYWw6IHRydWUsXHJcbiAgICAgICAgICAgICAgICB9XHJcbiAgICAgICAgICAgIH0sXHJcbiAgICAgICAgICAgIHtcclxuICAgICAgICAgICAgICAgIGJyZWFrcG9pbnQ6IDM2MCxcclxuICAgICAgICAgICAgICAgIHNldHRpbmdzOiB7XHJcbiAgICAgICAgICAgICAgICAgICAgdmVydGljYWw6IGZhbHNlLFxyXG4gICAgICAgICAgICAgICAgfVxyXG4gICAgICAgICAgICB9LFxyXG4gICAgICAgIF1cclxuXHJcbiAgICB9KTtcclxuXHJcbi8qIE1PQklMRSBNRU5VICovXHJcblxyXG5cdCQoICd1bCA+Lm1lbnUtaXRlbS1oYXMtY2hpbGRyZW4+YScgKS5vbiggJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdGUucHJldmVudERlZmF1bHQoKTtcclxuXHRcdCQoIHRoaXMgKS5wYXJlbnQoKS5maW5kKCAndWwuc3ViLW1lbnUnICkudG9nZ2xlKCk7XHJcblx0fSApO1xyXG5cclxuLyogU1RJQ0tZIE1FTlUgKi9cclxuXHQkKHdpbmRvdykuc2Nyb2xsKGZ1bmN0aW9uKCkge1xyXG5cdFx0aWYgKCAkKHdpbmRvdykuc2Nyb2xsVG9wKCkgPiA1MCApIHtcclxuXHJcblx0XHRcdCQoICcjc3RpY2t5LW1lbnUnICkuYWRkQ2xhc3MoICdzaG93LXN0aWNreScgKTtcclxuXHRcdH1cclxuXHRcdGVsc2Uge1xyXG5cdFx0XHQkKCAnI3N0aWNreS1tZW51JyApLnJlbW92ZUNsYXNzKCdzaG93LXN0aWNreScpO1xyXG5cdFx0fVxyXG5cdH0gKTtcclxuXHJcbi8qIExvYWRlciAqL1xyXG5cdCQod2luZG93KS5sb2FkKGZ1bmN0aW9uKCkge1xyXG5cdFx0JChcIi5sb2FkZXJfYm9vc3RpZnlcIikuZGVsYXkoMCkuZmFkZU91dChcInNsb3dcIik7XHJcblx0XHQkKFwiI292ZXJsYXllclwiKS5kZWxheSgwKS5mYWRlT3V0KFwic2xvd1wiKTtcclxuXHR9ICk7XHJcblxyXG4vKiBTd2F0Y2ggTGlzdCAqL1xyXG5cclxuXHQkKCAnLnByby1zd2F0Y2gtbGlzdCcgKS5vbiggJ2NsaWNrJywgJy5wLWF0dHItc3dhdGNoJywgZnVuY3Rpb24oKXtcclxuXHRcdHZhciBpbWdfc3JjID0gdm9pZCAwO1xyXG5cdFx0dmFyIHNyYyA9ICQodGhpcykuYXR0ciggJ2RhdGEtc3JjJyApO1xyXG5cdFx0dmFyIGltZ193cmFwID0gJCh0aGlzKS5wYXJlbnRzKCdsaS5wcm9kdWN0JykuZmluZCgnLnByb2R1Y3QtaW1hZ2Utd3JhcHBlcicpO1xyXG5cdFx0JCh0aGlzKS5wYXJlbnQoKS5maW5kKCcuYWN0aXZlJykucmVtb3ZlQ2xhc3MoJ2FjdGl2ZScpO1xyXG5cdFx0JCh0aGlzKS5hZGRDbGFzcygnYWN0aXZlJyk7XHJcblx0XHR2YXIgaW1nID0gaW1nX3dyYXAuZmluZCgnaW1nLnByb2R1Y3QtdGh1bWInKTtcclxuXHJcblx0XHRpZiAoIHNyYyA9PSBpbWdfc3JjICkge1xyXG5cdFx0XHRyZXR1cm47XHJcblx0XHR9XHJcblxyXG5cdFx0aW1nX3dyYXAuYWRkQ2xhc3MoJ2ltYWdlLWlzLWxvYWRpbmcnKTtcclxuXHRcdGltZy5hdHRyKCdzcmMnLCBzcmMpO1xyXG5cdFx0aW1nLmF0dHIoJ3NyY3NldCcsIHNyYykub25lKCdsb2FkJywgZnVuY3Rpb24gKCkge1xyXG5cdFx0XHRyZXR1cm4gaW1nX3dyYXAucmVtb3ZlQ2xhc3MoJ2ltYWdlLWlzLWxvYWRpbmcnKTtcclxuXHRcdH0pO1xyXG5cdH0pO1xyXG5cclxuXHQkKCAnLmNhdC1wYXJlbnQnICkuYXBwZW5kKCAnPHNwYW4gY2xhc3M9XCJpb24tYW5kcm9pZC1hZGQgY2F0LXRvZ2dsZVwiPjwvc3Bhbj4nICk7XHJcblx0JCggJy5jYXQtcGFyZW50JyApLmFkZENsYXNzKCdkaXNhYmxlJyk7XHJcblxyXG5cdCQoICcuY2F0LXBhcmVudCcgKS5vbiggJ2NsaWNrJywgZnVuY3Rpb24gKGFyZ3VtZW50KSB7XHJcblx0XHR2YXIgY2F0ID0gJCh0aGlzKSxcclxuXHRcdFx0YnRuID0gJCh0aGlzKS5maW5kKCcuY2F0LXRvZ2dsZScpLFxyXG5cdFx0XHRjaGlsZHJlbiA9ICQodGhpcykuZmluZCgnLmNoaWxkcmVuJyk7XHJcblx0XHRpZiAoIGNhdC5oYXNDbGFzcygnYWN0aXZlJykgKSB7XHJcblx0XHRcdGNhdC5yZW1vdmVDbGFzcyggJ2FjdGl2ZScgKS5hZGRDbGFzcygnZGlzYWJsZScpO1xyXG5cdFx0XHRjaGlsZHJlbi5yZW1vdmVDbGFzcygnY2hpbGRyZW4tYWN0aXZlJyk7XHJcblx0XHRcdGJ0bi5yZW1vdmVDbGFzcygnaW9uLWFuZHJvaWQtcmVtb3ZlJykuYWRkQ2xhc3MoJ2lvbi1hbmRyb2lkLWFkZCcpO1xyXG5cdFx0fVxyXG5cdFx0ZWxzZSB7XHJcblx0XHRcdGNhdC5hZGRDbGFzcygnYWN0aXZlJykucmVtb3ZlQ2xhc3MoJ2Rpc2FibGUnKTtcclxuXHRcdFx0Y2hpbGRyZW4uYWRkQ2xhc3MoJ2NoaWxkcmVuLWFjdGl2ZScpO1xyXG5cdFx0XHRidG4ucmVtb3ZlQ2xhc3MoJ2lvbi1hbmRyb2lkLWFkZCcpLmFkZENsYXNzKCdpb24tYW5kcm9pZC1yZW1vdmUnKTtcclxuXHRcdH1cclxuXHJcblx0fSApO1xyXG5cclxuXHJcblxyXG59KShqUXVlcnkpO1xyXG4iXSwiZmlsZSI6ImxlYWRjb24uanMifQ==
