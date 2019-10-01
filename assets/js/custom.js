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
//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJjdXN0b20uanMiXSwic291cmNlc0NvbnRlbnQiOlsiKCBmdW5jdGlvbiggJCApIHtcclxuXHQndXNlIHN0cmljdCc7XHJcbi8qKlxyXG4gKiBUb3Agc2VhcmNoIGZvcm0gZnVuY3Rpb25zLlxyXG4gKi9cclxuXHR2YXIgc2VhcmNoQ29udGFpbmVyID0gJCgnLnNpdGUtc2VhcmNoJyk7XHJcblxyXG5cdCQoICcuanMtc2VhcmNoJyApLm9uKCAnY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcblx0XHQkKCAnI2NvbnRlbnQtYWN0aW9uLXNlYXJjaCcgKS5hZGRDbGFzcyggJ3NlYXJjaC1zaG93JyApO1xyXG5cdH0gKTtcclxuXHJcblx0JCggJy5zaXRlLXNlYXJjaC1jbG9zZScgKS5vbignY2xpY2snLCBmdW5jdGlvbiAoKSB7XHJcblx0XHQkKCAnI2NvbnRlbnQtYWN0aW9uLXNlYXJjaCcgKS5yZW1vdmVDbGFzcyggJ3NlYXJjaC1zaG93JyApO1xyXG5cdH0pO1xyXG5cclxuXHJcbi8qIFNDUk9MTCBUT1AgKi9cclxuXHJcblx0JCh3aW5kb3cpLnNjcm9sbChmdW5jdGlvbigpIHtcclxuXHRcdGlmICggJCh3aW5kb3cpLnNjcm9sbFRvcCgpICA+IDEwMCApIHtcclxuXHRcdFx0JCggJy5idG4tYmFjay10by10b3AnICkucmVtb3ZlQ2xhc3MoJ2J0bi1oaWRkZW4nKTtcclxuXHRcdFx0JCggJy5idG4tYmFjay10by10b3AnICkuYWRkQ2xhc3MoICdidG4tc2hvdycgKTtcclxuXHRcdH1cclxuXHRcdGVsc2Uge1xyXG5cdFx0XHQkKCAnLmJ0bi1iYWNrLXRvLXRvcCcgKS5yZW1vdmVDbGFzcygnYnRuLXNob3cnKTtcclxuXHRcdFx0JCggJy5idG4tYmFjay10by10b3AnICkuYWRkQ2xhc3MoJ2J0bi1oaWRkZW4nKTtcclxuXHRcdH1cclxuXHR9ICk7XHJcblxyXG5cdCQoICcuYnRuLWJhY2stdG8tdG9wJyApLm9uKCAnY2xpY2snLCBmdW5jdGlvbigpIHtcclxuXHRcdCQoJ2h0bWwsIGJvZHknKS5hbmltYXRlKHsgc2Nyb2xsVG9wOiAwIH0sIDUwMCk7XHJcblx0fSApO1xyXG5cclxufSApKCBqUXVlcnkgKTsiXSwiZmlsZSI6ImN1c3RvbS5qcyJ9
