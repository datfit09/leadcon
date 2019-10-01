( function( $ ) {
	'use strict';
/**
 * Top search form functions.
 */
	var searchContainer = $('.site-search');

	$( '.js-search' ).on( 'click', function () {
		$( '#content-action-search' ).addClass( 'search-show' );
	} );

	$( '.site-search-close' ).on('click', function () {
		$( '#content-action-search' ).removeClass( 'search-show' );
	});


/* SCROLL TOP */

	$(window).scroll(function() {
		if ( $(window).scrollTop()  > 100 ) {
			$( '.btn-back-to-top' ).removeClass('btn-hidden');
			$( '.btn-back-to-top' ).addClass( 'btn-show' );
		}
		else {
			$( '.btn-back-to-top' ).removeClass('btn-show');
			$( '.btn-back-to-top' ).addClass('btn-hidden');
		}
	} );

	$( '.btn-back-to-top' ).on( 'click', function() {
		$('html, body').animate({ scrollTop: 0 }, 500);
	} );

} )( jQuery );