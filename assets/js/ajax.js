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

//# sourceMappingURL=data:application/json;charset=utf8;base64,eyJ2ZXJzaW9uIjozLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiIiwic291cmNlcyI6WyJhamF4LmpzIl0sInNvdXJjZXNDb250ZW50IjpbIid1c2Ugc3RyaWN0JztcclxuXHJcbihmdW5jdGlvbiAoJCkge1xyXG5cdCd1c2Ugc3RyaWN0JztcclxuXHJcblx0JChcIjxzcGFuIGNsYXNzPSdtb2RpZnktcXR5IGRlYyBpb24tYW5kcm9pZC1yZW1vdmUnPjwvc3Bhbj5cIikuaW5zZXJ0QmVmb3JlKCcucXR5Jyk7XHJcblx0JChcIjxzcGFuIGNsYXNzPSdtb2RpZnktcXR5IGluYyBpb24tYW5kcm9pZC1hZGQnPjwvc3Bhbj5cIikuaW5zZXJ0QWZ0ZXIoXCIucXR5XCIpO1xyXG5cclxuLypcclxuICpBSkFYIEFERCBUTyBDQVJEXHJcbiAqL1xyXG5cclxuaW5wdXRRdWFudGl0eSgpO1xyXG5hZGRUb0NhcnQoKTtcclxuYWRkVG9DYXJ0U2luZ2xlKCk7XHJcbmRlbGV0ZVByb2R1Y3QoKTtcclxuYWRkVG9DYXJ0VmFyaWFibGVTaW5nbGUoKTtcclxuLypcclxuICpBSkFYIEFERCBUTyBXSVNITElTVFxyXG4gKi9cclxuXHJcblx0JCggJy55aXRoLXdjd2wtYWRkLWJ1dHRvbicgKS5vbiggJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHJcblx0XHR2YXIgJGlkID0gJCggdGhpcyApLmZpbmQoICcuYWRkX3RvX3dpc2hsaXN0JyApLmF0dHIoICdkYXRhLXByb2R1Y3QtaWQnICk7XHJcblx0XHR2YXIgZGF0YSA9IHtcclxuXHRcdFx0YWN0aW9uOiAnbGVhZGNvbl9hZGRfdG9fd2hpc2xpc3QnLFxyXG5cdFx0XHRhZGRfdG9fd2lzaGxpc3Q6ICRpZCxcclxuXHJcblx0XHR9O1xyXG5cclxuXHRcdHZhciBidG4gPSAkKCB0aGlzICk7XHJcblx0XHR2YXIgYWRkZWQgPSBidG4uc2libGluZ3MoJy55aXRoLXdjd2wtd2lzaGxpc3RhZGRlZGJyb3dzZScpO1xyXG5cclxuXHRcdCQuYWpheCh7XHJcblx0XHRcdHR5cGU6ICdHRVQnLFxyXG5cdFx0XHR1cmw6IHdjX2FkZF90b19jYXJ0X3BhcmFtcy5hamF4X3VybCxcclxuXHRcdFx0ZGF0YTogZGF0YSxcclxuXHRcdFx0YmVmb3JlU2VuZDogZnVuY3Rpb24gKGRhdGEpIHtcclxuXHRcdFx0XHRidG4ucmVtb3ZlQ2xhc3MoJ2FkZGVkJykuYWRkQ2xhc3MoJ2Vsb2FkaW5nJyk7XHJcblxyXG5cclxuXHRcdFx0fSxcclxuXHRcdFx0Y29tcGxldGU6IGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG5cdFx0XHRcdGJ0bi5jc3MoICdkaXNwbGF5JywgJ25vbmUnICk7XHJcblx0XHRcdFx0YWRkZWQucmVtb3ZlQ2xhc3MoJ2hpZGRlbicpO1xyXG5cdFx0XHRcdGFkZGVkLmNzcyggJ2Rpc3BsYXknLCAnYmxvY2snICk7XHJcblx0XHRcdH0sXHJcblx0XHRcdHN1Y2Nlc3M6IGZ1bmN0aW9uIChkYXRhKSB7XHJcblx0XHRcdFx0aWYgKCBkYXRhICkge1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5odG1sKCBkYXRhKTtcclxuXHRcdFx0XHR9ZWxzZXtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuaHRtbCggJ2Vycm9yJylcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0sXHJcblx0XHR9KTtcclxuXHJcblx0XHRyZXR1cm4gZmFsc2U7XHJcblx0fSApO1xyXG5cclxuLypcclxuICpBSkFYIFFVSUNLIFZJRVdcclxuICovXHJcblxyXG5cdCQoICcucHJvZHVjdC1xdWljay12aWV3LWJ0bicgKS5vbiggJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHJcblx0XHR2YXIgJGlkID0gJCggdGhpcyApLmF0dHIoICdkYXRhLXBpZCcgKTtcclxuXHJcblx0XHR2YXIgZGF0YSA9IHtcclxuXHRcdFx0YWN0aW9uOiAncXVpY2tfdmlldycsXHJcblx0XHRcdGlkOiAkaWQsXHJcblx0XHR9O1xyXG5cclxuXHRcdHZhciBsb2FkID0gJCggJyNzaG9wLXF1aWNrLXZpZXcnICkuYXR0ciggJ2RhdGEtbG9hZGVyJyApO1xyXG5cclxuXHRcdCQuYWpheCh7XHJcblx0XHRcdHR5cGU6ICdQT1NUJyxcclxuXHRcdFx0dXJsOiB3Y19hZGRfdG9fY2FydF9wYXJhbXMuYWpheF91cmwsXHJcblx0XHRcdGRhdGE6IGRhdGEsXHJcblx0XHRcdGJlZm9yZVNlbmQ6IGZ1bmN0aW9uIChkYXRhKSB7XHJcblxyXG5cdFx0XHRcdCQoICcjc2hvcC1vdmVybGF5JyApLmFkZENsYXNzKCAnc2hvdycgKTtcclxuXHRcdFx0XHQkKCAnI3Nob3AtcXVpY2stdmlldycgKS5jc3MoIHsnZGlzcGxheScgOiAnZmxleCd9ICk7XHJcblx0XHRcdFx0JCggJyNzaG9wLXF1aWNrLXZpZXcnICkuaHRtbCggJzxpbWcgc3JjPVwiJytsb2FkKydcIiBhbHQ9XCJMb2FkaW5nXCIgY2xhc3M9XCJxdWlja3ZpZXctbG9hZFwiPicgKTtcclxuXHRcdFx0XHQkKCAnI3Nob3AtcXVpY2stdmlldycgKS5hdHRyKCAnZGF0YS12aWV3X2lkJywgJGlkICk7XHJcblxyXG5cdFx0XHR9LFxyXG5cdFx0XHRjb21wbGV0ZTogZnVuY3Rpb24gKHJlc3BvbnNlKSB7XHJcblxyXG5cdFx0XHR9LFxyXG5cdFx0XHRzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSkge1xyXG5cdFx0XHRcdGlmICggZGF0YSApIHtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1xdWljay12aWV3JyApLmh0bWwoIGRhdGEpO1xyXG5cdFx0XHRcdH1lbHNle1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLXF1aWNrLXZpZXcnICkuaHRtbCggJ2Vycm9yJylcclxuXHRcdFx0XHR9XHJcblx0XHRcdFx0JChcIjxzcGFuIGNsYXNzPSdtb2RpZnktcXR5IGRlYyBpb24tYW5kcm9pZC1yZW1vdmUnPjwvc3Bhbj5cIikuaW5zZXJ0QmVmb3JlKCcucXR5Jyk7XHJcblx0XHRcdFx0JChcIjxzcGFuIGNsYXNzPSdtb2RpZnktcXR5IGluYyBpb24tYW5kcm9pZC1hZGQnPjwvc3Bhbj5cIikuaW5zZXJ0QWZ0ZXIoXCIucXR5XCIpO1xyXG5cdFx0XHRcdHZhciB2YXJpYXRpb25Gb3JtID0gJCgnZm9ybS52YXJpYXRpb25zX2Zvcm0nKTtcclxuXHRcdFx0XHRpZiAoIHVuZGVmaW5lZCAhPT0gdHlwZW9mKCB3Y19hZGRfdG9fY2FydF92YXJpYXRpb25fcGFyYW1zICkgKSB7XHJcblx0XHRcdFx0XHR2YXJpYXRpb25Gb3JtLndjX3ZhcmlhdGlvbl9mb3JtKCk7XHJcblx0XHRcdFx0XHR2YXJpYXRpb25Gb3JtLmZpbmQoICcudmFyaWF0aW9ucyBzZWxlY3QnICkuY2hhbmdlKCk7XHJcblx0XHRcdFx0XHR2YXJpYXRpb25Gb3JtLnRyaWdnZXIoJ3djX3ZhcmlhdGlvbl9mb3JtJyk7XHJcblx0XHRcdFx0XHR2YXJpYXRpb25Gb3JtLnRhd2N2c192YXJpYXRpb25fc3dhdGNoZXNfZm9ybSgpO1xyXG5cdFx0XHRcdH1cclxuXHRcdFx0XHRzbGlkZVF1aWNrVmlldygpO1xyXG5cclxuXHRcdFx0XHQkKCcuYnRuLXF1aWNrLXZpZXctY2xvc2UnKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLXF1aWNrLXZpZXcnICkuY3NzKCAnZGlzcGxheScsICdub25lJyApO1xyXG5cdFx0XHRcdFx0JCgnI3Nob3Atb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdzaG93LXF1aWNrdmlldyBzaG93Jyk7XHJcblx0XHRcdFx0fSk7XHJcblx0XHRcdFx0JCgnI3Nob3Atb3ZlcmxheScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtcXVpY2stdmlldycgKS5jc3MoICdkaXNwbGF5JywgJ25vbmUnICk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmNzcyggJ2Rpc3BsYXknLCAnbm9uZScgKTtcclxuXHRcdFx0XHRcdCQoIHRoaXMgKS5yZW1vdmVDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdFx0fSk7XHJcblx0XHRcdFx0JCggJyNzaG9wLXF1aWNrLXZpZXcgLnNpbmdsZV9hZGRfdG9fY2FydF9idXR0b24nICkuYWRkQ2xhc3MoICdhZGQtdG8tY2FydC1xdWlja3ZpZXcnICk7XHJcblx0XHRcdFx0YWRkVG9DYXJ0UXVpY2t2aWV3KCk7XHJcblx0XHRcdFx0YWRkVG9DYXJ0VmFyaWFibGVTaW5nbGUoKTtcclxuXHRcdFx0fSxcclxuXHRcdH0pO1xyXG5cdFx0cmV0dXJuIGZhbHNlO1xyXG5cdH0gKTtcclxuXHJcblxyXG4vKlxyXG4gKkFKQVggQUREIFRPIENBUkRcclxuICovXHJcblxyXG5cdGZ1bmN0aW9uIGFkZFRvQ2FydCgpIHtcclxuXHRcdCQoJy5hamF4X2FkZF90b19jYXJ0Jykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cdFx0XHR2YXIgdHh0MiA9ICQoXCI8YSBocmVmPSdjYXJ0JyBjbGFzcz0nYWRkZWQtdG8tY2FydCB3Yy1mb3J3YXJkIGxlYWRjb24tYWRkLXRvLWNhcnQtYnRuJz48L3A+XCIpLnRleHQoXCJcIik7XHJcblx0XHRcdHZhciAkcXR5ID0gJCggdGhpcyApLmF0dHIoICdkYXRhLXF1YW50aXR5JyApLFxyXG5cdFx0XHRcdCRpZCA9ICQoIHRoaXMgKS5hdHRyKCAnZGF0YS1wcm9kdWN0X2lkJyApO1xyXG5cdFx0XHR2YXIgZGF0YSA9IHtcclxuXHRcdFx0XHRhY3Rpb246ICdsZWFkY29uX2FqYXhfYWRkX3RvX2NhcnQnLFxyXG5cdFx0XHRcdGlkOiAkaWQsXHJcblx0XHRcdFx0c2t1OiAnJyxcclxuXHRcdFx0XHRxdWFudGl0eTogJHF0eSxcclxuXHRcdFx0fTtcclxuXHRcdFx0dmFyIGJ0biA9ICQoIHRoaXMgKTtcclxuXHRcdFx0JC5hamF4KHtcclxuXHRcdFx0XHR0eXBlOiAncG9zdCcsXHJcblx0XHRcdFx0dXJsOiB3Y19hZGRfdG9fY2FydF9wYXJhbXMuYWpheF91cmwsXHJcblx0XHRcdFx0ZGF0YTogZGF0YSxcclxuXHRcdFx0XHRiZWZvcmVTZW5kOiBmdW5jdGlvbiAoZGF0YSkge1xyXG5cdFx0XHRcdFx0YnRuLnJlbW92ZUNsYXNzKCdhZGRlZCcpLmFkZENsYXNzKCdlbG9hZGluZycpO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5hZGRDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLW92ZXJsYXknICkuYWRkQ2xhc3MoICdzaG93JyApO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcygnYWRkZWQnKS5hZGRDbGFzcygnZWxvYWRpbmcnKTtcclxuXHRcdFx0XHR9LFxyXG5cdFx0XHRcdGNvbXBsZXRlOiBmdW5jdGlvbiAocmVzcG9uc2UpIHtcclxuXHRcdFx0XHRcdGJ0bi5hZGRDbGFzcygnYWRkZWQnKS5yZW1vdmVDbGFzcygnZWxvYWRpbmcnKTtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuYWRkQ2xhc3MoJ2FkZGVkJykucmVtb3ZlQ2xhc3MoJ2Vsb2FkaW5nJyk7XHJcblx0XHRcdFx0XHQkKCBidG4gKS5jc3MoICdkaXNwbGF5JywgJ25vbmUnICk7XHJcblx0XHRcdFx0XHQkKCBidG4gKS5wYXJlbnQoJ2Rpdi5sZWFkY29uLWxvb3AtYWN0aW9uJykuYXBwZW5kKHR4dDIpO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdFx0c3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuaHRtbCggZGF0YSk7XHJcblx0XHRcdFx0XHR2YXIgdG90dGFsID0gJCggJy5jb3VudC1taW5pLWNhcnQnICkuaHRtbCgpO1xyXG5cdFx0XHRcdFx0JCggJy5jb3VudCcgKS5odG1sKCB0b3R0YWwgKTtcclxuXHRcdFx0XHRcdGRlbGV0ZVByb2R1Y3QoKTtcclxuXHRcdFx0XHRcdCQoJyNjbG9zZS1jYXJ0LXNpZGViYXInKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdFx0XHRcdCQoICcjc2hvcC1vdmVybGF5JyApLnJlbW92ZUNsYXNzKCAnc2hvdycgKTtcclxuXHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdFx0JCgnI3Nob3Atb3ZlcmxheScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkucmVtb3ZlQ2xhc3MoICdzaG93Y2FydCcgKTtcclxuXHRcdFx0XHRcdFx0JCggdGhpcyApLnJlbW92ZUNsYXNzKCAnc2hvdycgKTtcclxuXHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdH0pO1xyXG5cdFx0XHRyZXR1cm4gZmFsc2U7XHJcblx0XHR9KTtcclxuXHR9XHJcblxyXG5cdGZ1bmN0aW9uIGFkZFRvQ2FydFNpbmdsZSgpIHtcclxuXHRcdCQoJ2J1dHRvbi5zaW5nbGVfYWRkX3RvX2NhcnRfYnV0dG9uW25hbWU9YWRkLXRvLWNhcnRdJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cdFx0XHQkKCAnYm9keScgKS5hZGRDbGFzcyggJ2FjdGlvbi1zaG93LWFsbCcgKTtcclxuXHRcdFx0dmFyICRxdHkgPSAkKCAnLnF0eScgKS52YWwoKTtcclxuXHRcdFx0dmFyICRpZCA9ICQoIHRoaXMgKS5hdHRyKCAndmFsdWUnICk7XHJcblx0XHRcdHZhciBkYXRhID0ge1xyXG5cdFx0XHRcdGFjdGlvbjogJ2xlYWRjb25fYWpheF9hZGRfdG9fY2FydCcsXHJcblx0XHRcdFx0aWQ6ICRpZCxcclxuXHRcdFx0XHRxdWFudGl0eTogJHF0eSxcclxuXHRcdFx0fTtcclxuXHRcdFx0dmFyIGJ0biA9ICQoIHRoaXMgKTtcclxuXHRcdFx0JC5hamF4KHtcclxuXHRcdFx0XHR0eXBlOiAncG9zdCcsXHJcblx0XHRcdFx0dXJsOiB3Y19hZGRfdG9fY2FydF9wYXJhbXMuYWpheF91cmwsXHJcblx0XHRcdFx0ZGF0YTogZGF0YSxcclxuXHRcdFx0XHRiZWZvcmVTZW5kOiBmdW5jdGlvbiAoZGF0YSkge1xyXG5cdFx0XHRcdFx0YnRuLnJlbW92ZUNsYXNzKCdhZGRlZCcpLmFkZENsYXNzKCdlbG9hZGluZycpO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5hZGRDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLW92ZXJsYXknICkuYWRkQ2xhc3MoICdzaG93JyApO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcygnYWRkZWQnKS5hZGRDbGFzcygnZWxvYWRpbmcnKTtcclxuXHRcdFx0XHR9LFxyXG5cdFx0XHRcdGNvbXBsZXRlOiBmdW5jdGlvbiAocmVzcG9uc2UpIHtcclxuXHRcdFx0XHRcdGJ0bi5yZW1vdmVDbGFzcygnZWxvYWRpbmcnKS5hZGRDbGFzcygnYWRkZWQnKTtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuYWRkQ2xhc3MoJ2FkZGVkJykucmVtb3ZlQ2xhc3MoJ2Vsb2FkaW5nJyk7XHJcblx0XHRcdFx0fSxcclxuXHRcdFx0XHRzdWNjZXNzOiBmdW5jdGlvbiAoZGF0YSkge1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5odG1sKCBkYXRhKTtcclxuXHRcdFx0XHRcdHZhciB0b3R0YWwgPSAkKCAnLmNvdW50LW1pbmktY2FydCcgKS5odG1sKCk7XHJcblx0XHRcdFx0XHQkKCAnLmNvdW50JyApLmh0bWwoIHRvdHRhbCApO1xyXG5cdFx0XHRcdFx0ZGVsZXRlUHJvZHVjdCgpO1xyXG5cdFx0XHRcdFx0JCgnI2Nsb3NlLWNhcnQtc2lkZWJhcicpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkucmVtb3ZlQ2xhc3MoICdzaG93Y2FydCcgKTtcclxuXHRcdFx0XHRcdFx0JCggJyNzaG9wLW92ZXJsYXknICkucmVtb3ZlQ2xhc3MoICdzaG93JyApO1xyXG5cdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0XHQkKCcjc2hvcC1vdmVybGF5Jykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0XHQkKCB0aGlzICkucmVtb3ZlQ2xhc3MoICdzaG93JyApO1xyXG5cdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0fSxcclxuXHRcdFx0fSk7XHJcblx0XHRcdHJldHVybiBmYWxzZTtcclxuXHRcdH0pO1xyXG5cdH1cclxuXHJcblx0ZnVuY3Rpb24gYWRkVG9DYXJ0UXVpY2t2aWV3KCkge1xyXG5cdFx0JCgnYnV0dG9uLmFkZC10by1jYXJ0LXF1aWNrdmlld1tuYW1lPWFkZC10by1jYXJ0XScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdGUucHJldmVudERlZmF1bHQoKTtcclxuXHRcdFx0JCggJ2JvZHknICkuYWRkQ2xhc3MoICdhY3Rpb24tc2hvdy1hbGwgY2FydG9wZW4nICk7XHJcblx0XHRcdHZhciAkcXR5ID0gJCggJy5xdHknICkudmFsKCk7XHJcblx0XHRcdHZhciAkaWQgPSAkKCB0aGlzICkuYXR0ciggJ3ZhbHVlJyApO1xyXG5cdFx0XHR2YXIgZGF0YSA9IHtcclxuXHRcdFx0XHRhY3Rpb246ICdsZWFkY29uX2FqYXhfYWRkX3RvX2NhcnQnLFxyXG5cdFx0XHRcdGlkOiAkaWQsXHJcblx0XHRcdFx0cXVhbnRpdHk6ICRxdHksXHJcblx0XHRcdH07XHJcblx0XHRcdHZhciBidG4gPSAkKCB0aGlzICk7XHJcblx0XHRcdCQoICcjc2hvcC1vdmVybGF5JyApLmFkZENsYXNzKCAnc2hvdy1xdWlja3ZpZXcgc2hvdy1jYXJ0JyApO1xyXG5cdFx0XHQkLmFqYXgoe1xyXG5cdFx0XHRcdHR5cGU6ICdwb3N0JyxcclxuXHRcdFx0XHR1cmw6IHdjX2FkZF90b19jYXJ0X3BhcmFtcy5hamF4X3VybCxcclxuXHRcdFx0XHRkYXRhOiBkYXRhLFxyXG5cdFx0XHRcdGJlZm9yZVNlbmQ6IGZ1bmN0aW9uIChkYXRhKSB7XHJcblx0XHRcdFx0XHRidG4ucmVtb3ZlQ2xhc3MoJ2FkZGVkJykuYWRkQ2xhc3MoJ2Vsb2FkaW5nJyk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmFkZENsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3Atb3ZlcmxheScgKS5hZGRDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCdhZGRlZCcpLmFkZENsYXNzKCdlbG9hZGluZycpO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdFx0Y29tcGxldGU6IGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG5cdFx0XHRcdFx0YnRuLnJlbW92ZUNsYXNzKCdlbG9hZGluZycpLmFkZENsYXNzKCdhZGRlZCcpO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5hZGRDbGFzcygnYWRkZWQnKS5yZW1vdmVDbGFzcygnZWxvYWRpbmcnKTtcclxuXHRcdFx0XHR9LFxyXG5cdFx0XHRcdHN1Y2Nlc3M6IGZ1bmN0aW9uIChkYXRhKSB7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmh0bWwoIGRhdGEpO1xyXG5cdFx0XHRcdFx0dmFyIHRvdHRhbCA9ICQoICcuY291bnQtbWluaS1jYXJ0JyApLmh0bWwoKTtcclxuXHRcdFx0XHRcdCQoICcuY291bnQnICkuaHRtbCggdG90dGFsICk7XHJcblx0XHRcdFx0XHRkZWxldGVQcm9kdWN0KCk7XHJcblx0XHRcdFx0XHQkKCcjY2xvc2UtY2FydC1zaWRlYmFyJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0XHQkKCAnYm9keScgKS5yZW1vdmVDbGFzcygnY2FydG9wZW4nKTtcclxuXHRcdFx0XHRcdFx0JCgnI3Nob3Atb3ZlcmxheScpLnJlbW92ZUNsYXNzKCdzaG93LWNhcnQgc2hvdycpO1xyXG5cdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0XHQkKCcjc2hvcC1vdmVybGF5Jykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0XHQkKCB0aGlzICkucmVtb3ZlQ2xhc3MoICdzaG93IHNob3ctcXVpY2t2aWV3IHNob3ctY2FydCcgKTtcclxuXHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdH0pO1xyXG5cdFx0XHRyZXR1cm4gZmFsc2U7XHJcblx0XHR9KTtcclxuXHR9XHJcblxyXG5cdGZ1bmN0aW9uIGRlbGV0ZVByb2R1Y3QoKSB7XHJcblx0XHQkKCdib2R5Jykub24oJ2NsaWNrJywgJy5yZW1vdmVfZnJvbV9jYXJ0X2J1dHRvbicsIGZ1bmN0aW9uICgpe1xyXG5cdFx0XHR2YXIgJGJ0biA9ICQodGhpcyk7XHJcblx0XHRcdHZhciAkcHJvZHVjX2lkID0gcGFyc2VJbnQoICQoIHRoaXMgKS5hdHRyKCAnZGF0YS1wcm9kdWN0X2lkJyApICk7XHJcblx0XHRcdHZhciAka2V5ID0gJCggdGhpcyApLmF0dHIoICdkYXRhLWNhcnRfaXRlbV9rZXknICkgO1xyXG5cdFx0XHQkLmFqYXgoeyAvLyB5b3UgY2FuIGFsc28gdXNlICQucG9zdCBoZXJlXHJcblx0XHRcdFx0dXJsIDogd2NfYWRkX3RvX2NhcnRfcGFyYW1zLmFqYXhfdXJsLCAvLyBBSkFYIGhhbmRsZXJcclxuXHRcdFx0XHRkYXRhIDoge1xyXG5cdFx0XHRcdFx0YWN0aW9uOiAncmVtb3ZlX2l0ZW1fZnJvbV9jYXJ0JyxcclxuXHRcdFx0XHRcdGlkOiAkcHJvZHVjX2lkLFxyXG5cdFx0XHRcdFx0a2V5OiAka2V5XHJcblx0XHRcdFx0fSxcclxuXHRcdFx0XHR0eXBlIDogJ1BPU1QnLFxyXG5cdFx0XHRcdGRhdGFUeXBlOiAnanNvbicsXHJcblx0XHRcdFx0c3VjY2VzczogZnVuY3Rpb24ocmVzcG9uc2UpIHtcclxuXHRcdFx0XHRcdGlmICggISByZXNwb25zZSB8fCByZXNwb25zZS5lcnJvciApe1xyXG5cdFx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmh0bWwoIHJlc3BvbnNlLmVycm9yICk7XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHR2YXIgZnJhZ21lbnRzID0gcmVzcG9uc2UuZnJhZ21lbnRzO1xyXG5cdFx0XHRcdFx0aWYgKCBmcmFnbWVudHMgKSB7XHJcblx0XHRcdFx0XHRcdCQuZWFjaCggZnJhZ21lbnRzLCBmdW5jdGlvbigga2V5LCB2YWx1ZSApIHtcclxuXHRcdFx0XHRcdFx0XHQkKCBrZXkgKS5yZXBsYWNlV2l0aCggdmFsdWUgKTtcclxuXHRcdFx0XHRcdFx0fSk7XHJcblx0XHRcdFx0XHR9XHJcblx0XHRcdFx0XHQkKCcjY2xvc2UtY2FydC1zaWRlYmFyJykub24oJ2NsaWNrJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5yZW1vdmVDbGFzcyggJ3Nob3djYXJ0JyApO1xyXG5cdFx0XHRcdFx0XHQkKCAnI3Nob3Atb3ZlcmxheScgKS5yZW1vdmVDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdFx0XHR9KTtcclxuXHRcdFx0XHRcdCQoJyNzaG9wLW92ZXJsYXknKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdFx0XHRcdCQoIHRoaXMgKS5yZW1vdmVDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdFx0XHR9KTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0pO1xyXG5cdFx0fSk7XHJcblx0fTtcclxuXHJcblx0ZnVuY3Rpb24gc2xpZGVRdWlja1ZpZXcoKSB7XHJcblx0XHQkKCcuanMtcHJvZHVjdC10aHVtYi1xdWljay12aWV3Jykuc2xpY2soe1xyXG5cdFx0XHRkb3RzOiB0cnVlLFxyXG5cdFx0XHRpbmZpbml0ZTogdHJ1ZSxcclxuXHRcdFx0c3BlZWQ6IDMwMCxcclxuXHRcdFx0c2xpZGVzVG9TaG93OiAxLFxyXG5cdFx0XHRhZGFwdGl2ZUhlaWdodDogdHJ1ZSxcclxuXHRcdFx0cHJldkFycm93OiAkKCcuYnV0dG9uLXF1aWNrdmlldy1wcmV2JyksXHJcblx0XHRcdG5leHRBcnJvdzogJCgnLmJ1dHRvbi1xdWlja3ZpZXctbmV4dCcpLFxyXG5cdFx0fSk7XHJcblx0fTtcclxuXHJcblx0ZnVuY3Rpb24gaW5wdXRRdWFudGl0eSAoKSB7XHJcblx0XHQkKCdib2R5Jykub24oJ2NsaWNrJywgJy5pbmMnLCBmdW5jdGlvbiAoKXtcclxuXHRcdFx0dmFyIHNwaW5uZXIgPSAkKCB0aGlzICkucGFyZW50cyggJy5xdWFudGl0eScgKTtcclxuXHRcdFx0dmFyIGlucHV0ID0gJCggc3Bpbm5lciApLmZpbmQoICcucXR5JyApO1xyXG5cdFx0XHR2YXIgbWluID0gaW5wdXQuYXR0cihcIm1pblwiKSxcclxuXHRcdFx0bWF4ID0gaW5wdXQuYXR0cihcIm1heFwiKTtcclxuXHRcdFx0dmFyIG9sZFZhbHVlID0gcGFyc2VGbG9hdChpbnB1dC52YWwoKSk7XHJcblx0XHRcdGlmICggbWF4ID09PSAnJyAgfHwgbWF4ID09PSAndW5kZWZpbmUnICkge1xyXG5cdFx0XHRcdHZhciBuZXdWYWwgPSBvbGRWYWx1ZSArIDE7XHJcblx0XHRcdH1cclxuXHRcdFx0ZWxzZXtcclxuXHRcdFx0XHRpZiAob2xkVmFsdWUgPj0gbWF4KSB7XHJcblx0XHRcdFx0XHR2YXIgbmV3VmFsID0gb2xkVmFsdWU7XHJcblx0XHRcdFx0fSBlbHNlIHtcclxuXHRcdFx0XHRcdHZhciBuZXdWYWwgPSBvbGRWYWx1ZSArIDE7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHR9XHJcblx0XHRcdHNwaW5uZXIuZmluZChcImlucHV0XCIpLnZhbChuZXdWYWwpO1xyXG5cdFx0XHRzcGlubmVyLmZpbmQoXCJpbnB1dFwiKS50cmlnZ2VyKFwiY2hhbmdlXCIpO1xyXG5cdFx0fSk7XHJcblxyXG5cdFx0JCgnYm9keScpLm9uKCdjbGljaycsICcuZGVjJywgZnVuY3Rpb24gKCl7XHJcblx0XHRcdHZhciBzcGlubmVyID0gJCggdGhpcyApLnBhcmVudHMoICcucXVhbnRpdHknICk7XHJcblx0XHRcdHZhciBpbnB1dCA9ICQoIHNwaW5uZXIgKS5maW5kKCAnLnF0eScgKTtcclxuXHRcdFx0dmFyIG1pbiA9IGlucHV0LmF0dHIoXCJtaW5cIiksXHJcblx0XHRcdG1heCA9IGlucHV0LmF0dHIoXCJtYXhcIik7XHJcblx0XHRcdHZhciBvbGRWYWx1ZSA9IHBhcnNlRmxvYXQoaW5wdXQudmFsKCkpO1xyXG5cdFx0XHRpZiAob2xkVmFsdWUgPD0gbWluKSB7XHJcblx0XHRcdFx0dmFyIG5ld1ZhbCA9IG9sZFZhbHVlO1xyXG5cdFx0XHR9IGVsc2Uge1xyXG5cdFx0XHRcdHZhciBuZXdWYWwgPSBvbGRWYWx1ZSAtIDE7XHJcblx0XHRcdH1cclxuXHRcdFx0c3Bpbm5lci5maW5kKFwiaW5wdXRcIikudmFsKG5ld1ZhbCk7XHJcblx0XHRcdHNwaW5uZXIuZmluZChcImlucHV0XCIpLnRyaWdnZXIoXCJjaGFuZ2VcIik7XHJcblx0XHR9KTtcclxuXHJcblx0fTtcclxuXHJcblxyXG5cdGpRdWVyeSggZG9jdW1lbnQuYm9keSApLm9uKCAndXBkYXRlZF9jYXJ0X3RvdGFscycsIGZ1bmN0aW9uKCkge1xyXG5cdFx0JChcIjxzcGFuIGNsYXNzPSdtb2RpZnktcXR5IGRlYyBpb24tYW5kcm9pZC1yZW1vdmUnPjwvc3Bhbj5cIikuaW5zZXJ0QmVmb3JlKCcucXR5Jyk7XHJcblx0XHQkKFwiPHNwYW4gY2xhc3M9J21vZGlmeS1xdHkgaW5jIGlvbi1hbmRyb2lkLWFkZCc+PC9zcGFuPlwiKS5pbnNlcnRBZnRlcihcIi5xdHlcIik7XHJcblx0fSApO1xyXG5cclxuLyogUVVJQ0tWSUVXIFNXQVRDSCAqL1xyXG5cclxuXHQkKCAnYm9keScgKS5vbiggJ2NsaWNrJywgJy5zd2F0Y2gtY29sb3InLCBmdW5jdGlvbiAoKSB7XHJcblx0XHR2YXIgcHJvZHVjdElkID0gJCh0aGlzKS5wYXJlbnRzKCdmb3JtLmNhcnQnKS5hdHRyKCdkYXRhLXByb2R1Y3RfaWQnKTtcclxuXHRcdHZhciBhdHRyaWJ1dGUgPSAnJztcclxuXHRcdHZhciBrZXkgPSAkKHRoaXMpLnBhcmVudHMoJy50YXdjdnMtc3dhdGNoZXMnKS5hdHRyKCdkYXRhLWF0dHJpYnV0ZV9uYW1lJyk7XHJcblx0XHR2YXIgdmFsdWUgPSAkKHRoaXMpLmF0dHIoJ2RhdGEtdmFsdWUnKTtcclxuXHRcdGF0dHJpYnV0ZSArPSBrZXkgKyAnPScgKyB2YWx1ZSArICcmJztcclxuXHRcdHZhciBuZXh0ID0gJCh0aGlzKS5wYXJlbnRzKCd0cicpLnNpYmxpbmdzKCkuZmluZCgnLnNlbGVjdGVkJyk7XHJcblx0XHRrZXkgPSBuZXh0LnBhcmVudHMoJy50YXdjdnMtc3dhdGNoZXMnKS5hdHRyKCdkYXRhLWF0dHJpYnV0ZV9uYW1lJyk7XHJcblx0XHR2YWx1ZSA9IG5leHQuYXR0cignZGF0YS12YWx1ZScpO1xyXG5cdFx0YXR0cmlidXRlICs9IGtleSArICc9JyArIHZhbHVlICsgJyYnICsgJ3Byb2R1Y3RfaWQ9JyArIHByb2R1Y3RJZCArICcmYWN0aW9uPWxlYWRjb25fc3dhdGNoX2ltYWdlJztcclxuXHRcdCQuYWpheCh7IC8vIHlvdSBjYW4gYWxzbyB1c2UgJC5wb3N0IGhlcmVcclxuXHRcdFx0dXJsIDogd2NfYWRkX3RvX2NhcnRfcGFyYW1zLmFqYXhfdXJsLCAvLyBBSkFYIGhhbmRsZXJcclxuXHRcdFx0ZGF0YSA6IGF0dHJpYnV0ZSxcclxuXHRcdFx0dHlwZSA6ICdHRVQnLFxyXG5cdFx0XHRkYXRhVHlwZTogJ2pzb24nLFxyXG5cdFx0XHRjYWNoZTogdHJ1ZSxcclxuXHRcdFx0YmVmb3JlU2VuZCA6IGZ1bmN0aW9uICggeGhyICkge1xyXG5cdFx0XHRcdCQoICcubGlzdC10aHVtYi1wcm9kdWN0JyApLmFkZENsYXNzKCdsb2FkaW5nJyk7XHJcblx0XHRcdH0sXHJcblx0XHRcdHN1Y2Nlc3M6IGZ1bmN0aW9uKHJlc3BvbnNlKSB7XHJcblx0XHRcdFx0JCggJy5saXN0LXRodW1iLXByb2R1Y3QnICkucmVtb3ZlQ2xhc3MoJ2xvYWRpbmcnKTtcclxuXHRcdFx0XHR2YXIgaW1hZ2UgPSAkKCcuaXRlbS10aHVtYltkYXRhLWlkPScgKyByZXNwb25zZSArICddJyk7XHJcblx0XHRcdFx0dmFyIGluZGV4ID0gaW1hZ2UucGFyZW50cygnLnNsaWNrLXNsaWRlJykuYXR0ciggJ2RhdGEtc2xpY2staW5kZXgnKTtcclxuXHRcdFx0XHQkKCcubGlzdC10aHVtYi1wcm9kdWN0Jykuc2xpY2soJ3NsaWNrR29UbycsIGluZGV4KTtcclxuXHRcdFx0fVxyXG5cdFx0fSk7XHJcblx0fSApO1xyXG5cclxuXHJcblx0ZnVuY3Rpb24gYWRkVG9DYXJ0VmFyaWFibGVTaW5nbGUoKSB7XHJcblx0XHQkKCcud29vY29tbWVyY2UtdmFyaWF0aW9uLWFkZC10by1jYXJ0Jykub24oJ2NsaWNrJywgJy5zaW5nbGVfYWRkX3RvX2NhcnRfYnV0dG9uJywgZnVuY3Rpb24gKGUpIHtcclxuXHRcdFx0ZS5wcmV2ZW50RGVmYXVsdCgpO1xyXG5cdFx0XHQkKCAnYm9keScgKS5hZGRDbGFzcyggJ2FjdGlvbi1zaG93LWFsbCcgKTtcclxuXHRcdFx0dmFyICRxdHkgPSAkKCAnLnF0eScgKS52YWwoKTtcclxuXHRcdFx0dmFyICRpZCA9ICQoICdpbnB1dFtuYW1lPXByb2R1Y3RfaWRdJyApLmF0dHIoICd2YWx1ZScgKTtcclxuXHRcdFx0dmFyICR2YXJpYXRpb25faWQgPSAkKCcudmFyaWF0aW9uX2lkJykudmFsKCk7XHJcblx0XHRcdHZhciBmb3JtID0gJCgnLnZhcmlhdGlvbnMnKS5maW5kKCcuc2VsZWN0ZWQnKTtcclxuXHRcdFx0dmFyIHZhcmlhdGlvbiA9IHt9O1xyXG5cdFx0XHRmb3JtLmVhY2goZnVuY3Rpb24gKGluZGV4KSB7XHJcblx0XHRcdFx0aWYgKCAkKCB0aGlzICkucGFyZW50cyggJy50YXdjdnMtc3dhdGNoZXMnICkuYXR0cignZGF0YS1hdHRyaWJ1dGVfbmFtZScpID09PSAnYXR0cmlidXRlX3BhX2NvbG9yJyApIHtcclxuXHRcdFx0XHRcdHZhcmlhdGlvbi5jb2xvciA9ICQoIHRoaXMgKS5hdHRyKCdkYXRhLXZhbHVlJyk7XHJcblx0XHRcdFx0fVxyXG5cdFx0XHRcdGlmICggJCggdGhpcyApLnBhcmVudHMoICcudGF3Y3ZzLXN3YXRjaGVzJyApLmF0dHIoJ2RhdGEtYXR0cmlidXRlX25hbWUnKSA9PT0gJ2F0dHJpYnV0ZV9wYV9zaXplJyApIHtcclxuXHRcdFx0XHRcdHZhcmlhdGlvbi5zaXplID0gJCggdGhpcyApLmF0dHIoJ2RhdGEtdmFsdWUnKTtcclxuXHRcdFx0XHR9XHJcblx0XHRcdH0pO1xyXG5cdFx0XHRkYXRhID0ge1xyXG5cdFx0XHRcdGFjdGlvbjogJ2xlYWRjb25fYWpheF9hZGRfdG9fY2FydF92YXJpYXRpb24nLFxyXG5cdFx0XHRcdGlkOiAkaWQsXHJcblx0XHRcdFx0cXVhbnRpdHk6ICRxdHksXHJcblx0XHRcdFx0dmFyaWF0aW9uX2lkOiAkdmFyaWF0aW9uX2lkLFxyXG5cdFx0XHRcdHZhcmlhdGlvbjogdmFyaWF0aW9uLFxyXG5cdFx0XHR9O1xyXG5cdFx0XHR2YXIgYnRuID0gJCggdGhpcyApO1xyXG5cdFx0XHQkLmFqYXgoe1xyXG5cdFx0XHRcdHR5cGU6ICdwb3N0JyxcclxuXHRcdFx0XHR1cmw6IHdjX2FkZF90b19jYXJ0X3BhcmFtcy5hamF4X3VybCxcclxuXHRcdFx0XHRkYXRhOiBkYXRhLFxyXG5cdFx0XHRcdGJlZm9yZVNlbmQ6IGZ1bmN0aW9uIChkYXRhKSB7XHJcblx0XHRcdFx0XHRidG4ucmVtb3ZlQ2xhc3MoJ2FkZGVkJykuYWRkQ2xhc3MoJ2Vsb2FkaW5nJyk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLmFkZENsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3Atb3ZlcmxheScgKS5hZGRDbGFzcyggJ3Nob3cnICk7XHJcblx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCdhZGRlZCcpLmFkZENsYXNzKCdlbG9hZGluZycpO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdFx0Y29tcGxldGU6IGZ1bmN0aW9uIChyZXNwb25zZSkge1xyXG5cdFx0XHRcdFx0YnRuLnJlbW92ZUNsYXNzKCdlbG9hZGluZycpLmFkZENsYXNzKCdhZGRlZCcpO1xyXG5cdFx0XHRcdFx0JCggJyNzaG9wLWNhcnQtc2lkZWJhcicgKS5hZGRDbGFzcygnYWRkZWQnKS5yZW1vdmVDbGFzcygnZWxvYWRpbmcnKTtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuY3NzKCB7ICdkaXNwbGF5JyA6ICdibG9jaycgfSApO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdFx0c3VjY2VzczogZnVuY3Rpb24gKGRhdGEpIHtcclxuXHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkuaHRtbCggZGF0YSk7XHJcblx0XHRcdFx0XHR2YXIgdG90dGFsID0gJCggJy5jb3VudC1taW5pLWNhcnQnICkuaHRtbCgpO1xyXG5cdFx0XHRcdFx0JCggJy5jb3VudCcgKS5odG1sKCB0b3R0YWwgKTtcclxuXHRcdFx0XHRcdGRlbGV0ZVByb2R1Y3QoKTtcclxuXHRcdFx0XHRcdCQoJyNjbG9zZS1jYXJ0LXNpZGViYXInKS5vbignY2xpY2snLCBmdW5jdGlvbiAoZSkge1xyXG5cdFx0XHRcdFx0XHQkKCAnI3Nob3AtY2FydC1zaWRlYmFyJyApLnJlbW92ZUNsYXNzKCAnc2hvd2NhcnQnICk7XHJcblx0XHRcdFx0XHRcdCQoICcjc2hvcC1vdmVybGF5JyApLnJlbW92ZUNsYXNzKCAnc2hvdycgKTtcclxuXHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdFx0JCgnI3Nob3Atb3ZlcmxheScpLm9uKCdjbGljaycsIGZ1bmN0aW9uIChlKSB7XHJcblx0XHRcdFx0XHRcdCQoICcjc2hvcC1jYXJ0LXNpZGViYXInICkucmVtb3ZlQ2xhc3MoICdzaG93Y2FydCcgKTtcclxuXHRcdFx0XHRcdFx0JCggdGhpcyApLnJlbW92ZUNsYXNzKCAnc2hvdycgKTtcclxuXHRcdFx0XHRcdH0pO1xyXG5cdFx0XHRcdH0sXHJcblx0XHRcdH0pO1xyXG5cdFx0XHRyZXR1cm4gZmFsc2U7XHJcblx0XHR9KTtcclxuXHR9XHJcblxyXG4vKiBTSU5HTEUgU1dBVENIICovXHJcblxyXG5cdCQoICdib2R5JyApLm9uKCAnY2xpY2snLCAnLnN3YXRjaC1jb2xvcicsIGZ1bmN0aW9uICgpIHtcclxuXHRcdHZhciBwcm9kdWN0SWQgPSAkKHRoaXMpLnBhcmVudHMoJ2Zvcm0uY2FydCcpLmF0dHIoJ2RhdGEtcHJvZHVjdF9pZCcpLFxyXG5cdFx0XHRhdHRyaWJ1dGUgPSAnJyxcclxuXHRcdFx0a2V5ID0gJCh0aGlzKS5wYXJlbnRzKCcudGF3Y3ZzLXN3YXRjaGVzJykuYXR0cignZGF0YS1hdHRyaWJ1dGVfbmFtZScpLFxyXG5cdFx0XHR2YWx1ZSA9ICQodGhpcykuYXR0cignZGF0YS12YWx1ZScpLFxyXG5cdFx0XHRuZXh0ID0gJCh0aGlzKS5wYXJlbnRzKCd0cicpLnNpYmxpbmdzKCkuZmluZCgnLnNlbGVjdGVkJyk7XHJcblx0XHRrZXkgPSBuZXh0LnBhcmVudHMoJy50YXdjdnMtc3dhdGNoZXMnKS5hdHRyKCdkYXRhLWF0dHJpYnV0ZV9uYW1lJyk7XHJcblx0XHR2YWx1ZSA9IG5leHQuYXR0cignZGF0YS12YWx1ZScpO1xyXG5cdFx0YXR0cmlidXRlICs9IGtleSArICc9JyArIHZhbHVlICsgJyYnICsgJ3Byb2R1Y3RfaWQ9JyArIHByb2R1Y3RJZCArICcmYWN0aW9uPWxlYWRjb25fc3dhdGNoX2ltYWdlJztcclxuXHRcdCQuYWpheCh7IC8vIHlvdSBjYW4gYWxzbyB1c2UgJC5wb3N0IGhlcmVcclxuXHRcdFx0dXJsIDogd2NfYWRkX3RvX2NhcnRfcGFyYW1zLmFqYXhfdXJsLCAvLyBBSkFYIGhhbmRsZXJcclxuXHRcdFx0ZGF0YSA6IGF0dHJpYnV0ZSxcclxuXHRcdFx0dHlwZSA6ICdHRVQnLFxyXG5cdFx0XHRkYXRhVHlwZTogJ2pzb24nLFxyXG5cdFx0XHRjYWNoZTogdHJ1ZSxcclxuXHRcdFx0YmVmb3JlU2VuZCA6IGZ1bmN0aW9uICggeGhyICkge1xyXG5cdFx0XHRcdCQoICcucHJvZHVjdC1pbWFnZS1zbGlkZXIgLnNsaWRlci1mb3InICkuYWRkQ2xhc3MoJ2xvYWRpbmcnKTtcclxuXHRcdFx0fSxcclxuXHRcdFx0c3VjY2VzczogZnVuY3Rpb24ocmVzcG9uc2UpIHtcclxuXHRcdFx0XHQkKCAnLnByb2R1Y3QtaW1hZ2Utc2xpZGVyIC5zbGlkZXItZm9yJyApLnJlbW92ZUNsYXNzKCdsb2FkaW5nJyk7XHJcblx0XHRcdFx0dmFyIGltYWdlID0gJCgnLnNsaWRlci1uYXYnKS5maW5kKCcuaW1nLWl0ZW1bZGF0YS1pZD0nICsgcmVzcG9uc2UgKyAnXScpO1xyXG5cdFx0XHRcdHZhciBpbmRleCA9IGltYWdlLnBhcmVudHMoJy5zbGljay1zbGlkZScpLmF0dHIoICdkYXRhLXNsaWNrLWluZGV4Jyk7XHJcblx0XHRcdFx0JCgnLnNsaWRlci1uYXYnKS5zbGljaygnc2xpY2tHb1RvJywgaW5kZXgpO1xyXG5cdFx0XHR9XHJcblx0XHR9KTtcclxuXHR9ICk7XHJcbn0pKGpRdWVyeSk7XHJcbiJdLCJmaWxlIjoiYWpheC5qcyJ9
