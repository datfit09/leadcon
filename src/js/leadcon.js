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
