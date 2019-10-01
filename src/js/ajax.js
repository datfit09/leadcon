'use strict';

(function ($) {
	'use strict';

	$("<span class='modify-qty dec ion-android-remove'></span>").insertBefore('.qty');
	$("<span class='modify-qty inc ion-android-add'></span>").insertAfter(".qty");

/*
 *AJAX ADD TO CARD
 */

inputQuantity();
addToCart();
addToCartSingle();
deleteProduct();
addToCartVariableSingle();
/*
 *AJAX ADD TO WISHLIST
 */

	$( '.yith-wcwl-add-button' ).on( 'click', function (e) {

		var $id = $( this ).find( '.add_to_wishlist' ).attr( 'data-product-id' );
		var data = {
			action: 'leadcon_add_to_whislist',
			add_to_wishlist: $id,

		};

		var btn = $( this );
		var added = btn.siblings('.yith-wcwl-wishlistaddedbrowse');

		$.ajax({
			type: 'GET',
			url: wc_add_to_cart_params.ajax_url,
			data: data,
			beforeSend: function (data) {
				btn.removeClass('added').addClass('eloading');


			},
			complete: function (response) {
				btn.css( 'display', 'none' );
				added.removeClass('hidden');
				added.css( 'display', 'block' );
			},
			success: function (data) {
				if ( data ) {
					$( '#shop-cart-sidebar' ).html( data);
				}else{
					$( '#shop-cart-sidebar' ).html( 'error')
				}
			},
		});

		return false;
	} );

/*
 *AJAX QUICK VIEW
 */

	$( '.product-quick-view-btn' ).on( 'click', function (e) {

		var $id = $( this ).attr( 'data-pid' );

		var data = {
			action: 'quick_view',
			id: $id,
		};

		var load = $( '#shop-quick-view' ).attr( 'data-loader' );

		$.ajax({
			type: 'POST',
			url: wc_add_to_cart_params.ajax_url,
			data: data,
			beforeSend: function (data) {

				$( '#shop-overlay' ).addClass( 'show' );
				$( '#shop-quick-view' ).css( {'display' : 'flex'} );
				$( '#shop-quick-view' ).html( '<img src="'+load+'" alt="Loading" class="quickview-load">' );
				$( '#shop-quick-view' ).attr( 'data-view_id', $id );

			},
			complete: function (response) {

			},
			success: function (data) {
				if ( data ) {
					$( '#shop-quick-view' ).html( data);
				}else{
					$( '#shop-quick-view' ).html( 'error')
				}
				$("<span class='modify-qty dec ion-android-remove'></span>").insertBefore('.qty');
				$("<span class='modify-qty inc ion-android-add'></span>").insertAfter(".qty");
				var variationForm = $('form.variations_form');
				if ( undefined !== typeof( wc_add_to_cart_variation_params ) ) {
					variationForm.wc_variation_form();
					variationForm.find( '.variations select' ).change();
					variationForm.trigger('wc_variation_form');
					variationForm.tawcvs_variation_swatches_form();
				}
				slideQuickView();

				$('.btn-quick-view-close').on('click', function (e) {
					$( '#shop-quick-view' ).css( 'display', 'none' );
					$('#shop-overlay').removeClass('show-quickview show');
				});
				$('#shop-overlay').on('click', function (e) {
					$( '#shop-quick-view' ).css( 'display', 'none' );
					$( '#shop-cart-sidebar' ).css( 'display', 'none' );
					$( this ).removeClass( 'show' );
				});
				$( '#shop-quick-view .single_add_to_cart_button' ).addClass( 'add-to-cart-quickview' );
				addToCartQuickview();
				addToCartVariableSingle();
			},
		});
		return false;
	} );


/*
 *AJAX ADD TO CARD
 */

	function addToCart() {
		$('.ajax_add_to_cart').on('click', function (e) {
			e.preventDefault();
			var txt2 = $("<a href='cart' class='added-to-cart wc-forward leadcon-add-to-cart-btn'></p>").text("");
			var $qty = $( this ).attr( 'data-quantity' ),
				$id = $( this ).attr( 'data-product_id' );
			var data = {
				action: 'leadcon_ajax_add_to_cart',
				id: $id,
				sku: '',
				quantity: $qty,
			};
			var btn = $( this );
			$.ajax({
				type: 'post',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (data) {
					btn.removeClass('added').addClass('eloading');
					$( '#shop-cart-sidebar' ).addClass( 'showcart' );
					$( '#shop-overlay' ).addClass( 'show' );
					$( '#shop-cart-sidebar' ).removeClass('added').addClass('eloading');
				},
				complete: function (response) {
					btn.addClass('added').removeClass('eloading');
					$( '#shop-cart-sidebar' ).addClass('added').removeClass('eloading');
					$( btn ).css( 'display', 'none' );
					$( btn ).parent('div.leadcon-loop-action').append(txt2);
				},
				success: function (data) {
					$( '#shop-cart-sidebar' ).html( data);
					var tottal = $( '.count-mini-cart' ).html();
					$( '.count' ).html( tottal );
					deleteProduct();
					$('#close-cart-sidebar').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( '#shop-overlay' ).removeClass( 'show' );
					});
					$('#shop-overlay').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( this ).removeClass( 'show' );
					});
				},
			});
			return false;
		});
	}

	function addToCartSingle() {
		$('button.single_add_to_cart_button[name=add-to-cart]').on('click', function (e) {
			e.preventDefault();
			$( 'body' ).addClass( 'action-show-all' );
			var $qty = $( '.qty' ).val();
			var $id = $( this ).attr( 'value' );
			var data = {
				action: 'leadcon_ajax_add_to_cart',
				id: $id,
				quantity: $qty,
			};
			var btn = $( this );
			$.ajax({
				type: 'post',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (data) {
					btn.removeClass('added').addClass('eloading');
					$( '#shop-cart-sidebar' ).addClass( 'showcart' );
					$( '#shop-overlay' ).addClass( 'show' );
					$( '#shop-cart-sidebar' ).removeClass('added').addClass('eloading');
				},
				complete: function (response) {
					btn.removeClass('eloading').addClass('added');
					$( '#shop-cart-sidebar' ).addClass('added').removeClass('eloading');
				},
				success: function (data) {
					$( '#shop-cart-sidebar' ).html( data);
					var tottal = $( '.count-mini-cart' ).html();
					$( '.count' ).html( tottal );
					deleteProduct();
					$('#close-cart-sidebar').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( '#shop-overlay' ).removeClass( 'show' );
					});
					$('#shop-overlay').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( this ).removeClass( 'show' );
					});
				},
			});
			return false;
		});
	}

	function addToCartQuickview() {
		$('button.add-to-cart-quickview[name=add-to-cart]').on('click', function (e) {
			e.preventDefault();
			$( 'body' ).addClass( 'action-show-all cartopen' );
			var $qty = $( '.qty' ).val();
			var $id = $( this ).attr( 'value' );
			var data = {
				action: 'leadcon_ajax_add_to_cart',
				id: $id,
				quantity: $qty,
			};
			var btn = $( this );
			$( '#shop-overlay' ).addClass( 'show-quickview show-cart' );
			$.ajax({
				type: 'post',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (data) {
					btn.removeClass('added').addClass('eloading');
					$( '#shop-cart-sidebar' ).addClass( 'showcart' );
					$( '#shop-overlay' ).addClass( 'show' );
					$( '#shop-cart-sidebar' ).removeClass('added').addClass('eloading');
				},
				complete: function (response) {
					btn.removeClass('eloading').addClass('added');
					$( '#shop-cart-sidebar' ).addClass('added').removeClass('eloading');
				},
				success: function (data) {
					$( '#shop-cart-sidebar' ).html( data);
					var tottal = $( '.count-mini-cart' ).html();
					$( '.count' ).html( tottal );
					deleteProduct();
					$('#close-cart-sidebar').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( 'body' ).removeClass('cartopen');
						$('#shop-overlay').removeClass('show-cart show');
					});
					$('#shop-overlay').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( this ).removeClass( 'show show-quickview show-cart' );
					});
				},
			});
			return false;
		});
	}

	function deleteProduct() {
		$('body').on('click', '.remove_from_cart_button', function (){
			var $btn = $(this);
			var $produc_id = parseInt( $( this ).attr( 'data-product_id' ) );
			var $key = $( this ).attr( 'data-cart_item_key' ) ;
			$.ajax({ // you can also use $.post here
				url : wc_add_to_cart_params.ajax_url, // AJAX handler
				data : {
					action: 'remove_item_from_cart',
					id: $produc_id,
					key: $key
				},
				type : 'POST',
				dataType: 'json',
				success: function(response) {
					if ( ! response || response.error ){
						$( '#shop-cart-sidebar' ).html( response.error );
					}
					var fragments = response.fragments;
					if ( fragments ) {
						$.each( fragments, function( key, value ) {
							$( key ).replaceWith( value );
						});
					}
					$('#close-cart-sidebar').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( '#shop-overlay' ).removeClass( 'show' );
					});
					$('#shop-overlay').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( this ).removeClass( 'show' );
					});
				}
			});
		});
	};

	function slideQuickView() {
		$('.js-product-thumb-quick-view').slick({
			dots: true,
			infinite: true,
			speed: 300,
			slidesToShow: 1,
			adaptiveHeight: true,
			prevArrow: $('.button-quickview-prev'),
			nextArrow: $('.button-quickview-next'),
		});
	};

	function inputQuantity () {
		$('body').on('click', '.inc', function (){
			var spinner = $( this ).parents( '.quantity' );
			var input = $( spinner ).find( '.qty' );
			var min = input.attr("min"),
			max = input.attr("max");
			var oldValue = parseFloat(input.val());
			if ( max === ''  || max === 'undefine' ) {
				var newVal = oldValue + 1;
			}
			else{
				if (oldValue >= max) {
					var newVal = oldValue;
				} else {
					var newVal = oldValue + 1;
				}
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});

		$('body').on('click', '.dec', function (){
			var spinner = $( this ).parents( '.quantity' );
			var input = $( spinner ).find( '.qty' );
			var min = input.attr("min"),
			max = input.attr("max");
			var oldValue = parseFloat(input.val());
			if (oldValue <= min) {
				var newVal = oldValue;
			} else {
				var newVal = oldValue - 1;
			}
			spinner.find("input").val(newVal);
			spinner.find("input").trigger("change");
		});

	};


	jQuery( document.body ).on( 'updated_cart_totals', function() {
		$("<span class='modify-qty dec ion-android-remove'></span>").insertBefore('.qty');
		$("<span class='modify-qty inc ion-android-add'></span>").insertAfter(".qty");
	} );

/* QUICKVIEW SWATCH */

	$( 'body' ).on( 'click', '.swatch-color', function () {
		var productId = $(this).parents('form.cart').attr('data-product_id');
		var attribute = '';
		var key = $(this).parents('.tawcvs-swatches').attr('data-attribute_name');
		var value = $(this).attr('data-value');
		attribute += key + '=' + value + '&';
		var next = $(this).parents('tr').siblings().find('.selected');
		key = next.parents('.tawcvs-swatches').attr('data-attribute_name');
		value = next.attr('data-value');
		attribute += key + '=' + value + '&' + 'product_id=' + productId + '&action=leadcon_swatch_image';
		$.ajax({ // you can also use $.post here
			url : wc_add_to_cart_params.ajax_url, // AJAX handler
			data : attribute,
			type : 'GET',
			dataType: 'json',
			cache: true,
			beforeSend : function ( xhr ) {
				$( '.list-thumb-product' ).addClass('loading');
			},
			success: function(response) {
				$( '.list-thumb-product' ).removeClass('loading');
				var image = $('.item-thumb[data-id=' + response + ']');
				var index = image.parents('.slick-slide').attr( 'data-slick-index');
				$('.list-thumb-product').slick('slickGoTo', index);
			}
		});
	} );


	function addToCartVariableSingle() {
		$('.woocommerce-variation-add-to-cart').on('click', '.single_add_to_cart_button', function (e) {
			e.preventDefault();
			$( 'body' ).addClass( 'action-show-all' );
			var $qty = $( '.qty' ).val();
			var $id = $( 'input[name=product_id]' ).attr( 'value' );
			var $variation_id = $('.variation_id').val();
			var form = $('.variations').find('.selected');
			var variation = {};
			form.each(function (index) {
				if ( $( this ).parents( '.tawcvs-swatches' ).attr('data-attribute_name') === 'attribute_pa_color' ) {
					variation.color = $( this ).attr('data-value');
				}
				if ( $( this ).parents( '.tawcvs-swatches' ).attr('data-attribute_name') === 'attribute_pa_size' ) {
					variation.size = $( this ).attr('data-value');
				}
			});
			data = {
				action: 'leadcon_ajax_add_to_cart_variation',
				id: $id,
				quantity: $qty,
				variation_id: $variation_id,
				variation: variation,
			};
			var btn = $( this );
			$.ajax({
				type: 'post',
				url: wc_add_to_cart_params.ajax_url,
				data: data,
				beforeSend: function (data) {
					btn.removeClass('added').addClass('eloading');
					$( '#shop-cart-sidebar' ).addClass( 'showcart' );
					$( '#shop-overlay' ).addClass( 'show' );
					$( '#shop-cart-sidebar' ).removeClass('added').addClass('eloading');
				},
				complete: function (response) {
					btn.removeClass('eloading').addClass('added');
					$( '#shop-cart-sidebar' ).addClass('added').removeClass('eloading');
					$( '#shop-cart-sidebar' ).css( { 'display' : 'block' } );
				},
				success: function (data) {
					$( '#shop-cart-sidebar' ).html( data);
					var tottal = $( '.count-mini-cart' ).html();
					$( '.count' ).html( tottal );
					deleteProduct();
					$('#close-cart-sidebar').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( '#shop-overlay' ).removeClass( 'show' );
					});
					$('#shop-overlay').on('click', function (e) {
						$( '#shop-cart-sidebar' ).removeClass( 'showcart' );
						$( this ).removeClass( 'show' );
					});
				},
			});
			return false;
		});
	}

/* SINGLE SWATCH */

	$( 'body' ).on( 'click', '.swatch-color', function () {
		var productId = $(this).parents('form.cart').attr('data-product_id'),
			attribute = '',
			key = $(this).parents('.tawcvs-swatches').attr('data-attribute_name'),
			value = $(this).attr('data-value'),
			next = $(this).parents('tr').siblings().find('.selected');
		key = next.parents('.tawcvs-swatches').attr('data-attribute_name');
		value = next.attr('data-value');
		attribute += key + '=' + value + '&' + 'product_id=' + productId + '&action=leadcon_swatch_image';
		$.ajax({ // you can also use $.post here
			url : wc_add_to_cart_params.ajax_url, // AJAX handler
			data : attribute,
			type : 'GET',
			dataType: 'json',
			cache: true,
			beforeSend : function ( xhr ) {
				$( '.product-image-slider .slider-for' ).addClass('loading');
			},
			success: function(response) {
				$( '.product-image-slider .slider-for' ).removeClass('loading');
				var image = $('.slider-nav').find('.img-item[data-id=' + response + ']');
				var index = image.parents('.slick-slide').attr( 'data-slick-index');
				$('.slider-nav').slick('slickGoTo', index);
			}
		});
	} );
})(jQuery);
