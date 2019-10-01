/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	'use strict';
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJjdXN0b21pemVyLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIi8qKlxyXG4gKiBGaWxlIGN1c3RvbWl6ZXIuanMuXHJcbiAqXHJcbiAqIFRoZW1lIEN1c3RvbWl6ZXIgZW5oYW5jZW1lbnRzIGZvciBhIGJldHRlciB1c2VyIGV4cGVyaWVuY2UuXHJcbiAqXHJcbiAqIENvbnRhaW5zIGhhbmRsZXJzIHRvIG1ha2UgVGhlbWUgQ3VzdG9taXplciBwcmV2aWV3IHJlbG9hZCBjaGFuZ2VzIGFzeW5jaHJvbm91c2x5LlxyXG4gKi9cclxuXHJcbiggZnVuY3Rpb24oICQgKSB7XHJcblx0J3VzZSBzdHJpY3QnO1xyXG5cdC8vIFNpdGUgdGl0bGUgYW5kIGRlc2NyaXB0aW9uLlxyXG5cdHdwLmN1c3RvbWl6ZSggJ2Jsb2duYW1lJywgZnVuY3Rpb24oIHZhbHVlICkge1xyXG5cdFx0dmFsdWUuYmluZCggZnVuY3Rpb24oIHRvICkge1xyXG5cdFx0XHQkKCAnLnNpdGUtdGl0bGUgYScgKS50ZXh0KCB0byApO1xyXG5cdFx0fSApO1xyXG5cdH0gKTtcclxuXHR3cC5jdXN0b21pemUoICdibG9nZGVzY3JpcHRpb24nLCBmdW5jdGlvbiggdmFsdWUgKSB7XHJcblx0XHR2YWx1ZS5iaW5kKCBmdW5jdGlvbiggdG8gKSB7XHJcblx0XHRcdCQoICcuc2l0ZS1kZXNjcmlwdGlvbicgKS50ZXh0KCB0byApO1xyXG5cdFx0fSApO1xyXG5cdH0gKTtcclxuXHJcblx0Ly8gSGVhZGVyIHRleHQgY29sb3IuXHJcblx0d3AuY3VzdG9taXplKCAnaGVhZGVyX3RleHRjb2xvcicsIGZ1bmN0aW9uKCB2YWx1ZSApIHtcclxuXHRcdHZhbHVlLmJpbmQoIGZ1bmN0aW9uKCB0byApIHtcclxuXHRcdFx0aWYgKCAnYmxhbmsnID09PSB0byApIHtcclxuXHRcdFx0XHQkKCAnLnNpdGUtdGl0bGUsIC5zaXRlLWRlc2NyaXB0aW9uJyApLmNzcygge1xyXG5cdFx0XHRcdFx0J2NsaXAnOiAncmVjdCgxcHgsIDFweCwgMXB4LCAxcHgpJyxcclxuXHRcdFx0XHRcdCdwb3NpdGlvbic6ICdhYnNvbHV0ZSdcclxuXHRcdFx0XHR9ICk7XHJcblx0XHRcdH0gZWxzZSB7XHJcblx0XHRcdFx0JCggJy5zaXRlLXRpdGxlLCAuc2l0ZS1kZXNjcmlwdGlvbicgKS5jc3MoIHtcclxuXHRcdFx0XHRcdCdjbGlwJzogJ2F1dG8nLFxyXG5cdFx0XHRcdFx0J3Bvc2l0aW9uJzogJ3JlbGF0aXZlJ1xyXG5cdFx0XHRcdH0gKTtcclxuXHRcdFx0XHQkKCAnLnNpdGUtdGl0bGUgYSwgLnNpdGUtZGVzY3JpcHRpb24nICkuY3NzKCB7XHJcblx0XHRcdFx0XHQnY29sb3InOiB0b1xyXG5cdFx0XHRcdH0gKTtcclxuXHRcdFx0fVxyXG5cdFx0fSApO1xyXG5cdH0gKTtcclxufSApKCBqUXVlcnkgKTtcclxuIl0sImZpbGUiOiJjdXN0b21pemVyLmpzIn0=
