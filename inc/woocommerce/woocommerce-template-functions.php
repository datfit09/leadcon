<?php


remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_sidebar', 'leadcon_get_shop_sidebar', 10 );

function leadcon_get_shop_sidebar() {
	$shop_layout = get_theme_mod( 'leadcon_shop_layout', 'right-sidebar' );

	if ( is_active_sidebar( 'sidebar-3' ) && 'no-sidebar' !== $shop_layout && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		?>
			<aside id="secondary" class="main-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</aside><!-- #secondary -->
		<?php
	}
}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

/* GET PRODUCT THUMBNAIL */
if ( ! function_exists( 'leadcon_get_product_thumbnail' ) ) {
	function leadcon_get_product_thumbnail( $size = 'woocommerce_thumbnail' ) {
		global $product;

		if ( ! $product ) {
			return '';
		}

		$variation  = $product->is_type( 'variable' );
		$img_id     = $product->get_image_id();
		$img_src    = array();
		$img_origin = wp_get_attachment_image_src( $img_id, $size );
		$img_alt    = leadcon_img_alt( $img_id, esc_attr__(  'Product image', 'leadcon'  ) );
		$image_attr = array(
			'alt'             => $img_alt,
			'data-origin_src' => $img_origin[0]
		);
		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

		if ( $variation ) {
			$vars         = $product->get_available_variations();
			$default_attr = method_exists( $product, 'get_default_attributes' ) ? $product->get_default_attributes() : array();
			$attributes   = $product->get_attributes();
			$output       = '';

			foreach ( $attributes as $key ) {
				$attr_type = $key['name'];

				foreach ( $vars as $key ) {
					$slug = isset( $key['attributes']['attribute_' . $attr_type] ) ? $key['attributes']['attribute_' . $attr_type] : '';

					if ( isset( $default_attr[$attr_type] ) && $default_attr[$attr_type] === $slug ) {
						/**
						*  $img_src get default image url
						*  $default_alt alt for variation image
						*  $img_props image attribute
						*/
						$img_src     = wp_get_attachment_image_src( $key['image_id'], $size );
						$default_alt = leadcon_img_alt( $key['image_id'], esc_attr__(  'Product image', 'leadcon'  ) );
						$img_props   = wc_get_product_attachment_props( $key['image_id'], $product );

						$default_image_attr = array(
							'width'           => $img_props['thumb_src_w'],
							'height'          => $img_props['thumb_src_h'],
							'src'             => $img_src[0],
							'alt'             => $default_alt,
							'data-origin_src' => $img_origin[0],
							'srcset'          => $img_props['srcset']
						);

						$default_image_attr['sizes']  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $img_id, 'woocommerce_thumbnail' ) : false;

						$output = implode( ' ', array_map(
							function ( $v, $k ) {
								return sprintf( "%s='%s'", $k, $v );
							},
							$default_image_attr,
							array_keys( $default_image_attr )
						) );
						break;
					}
				}
			}

			if ( ! empty( $img_src ) ) {
				return '<img class="product-thumb" ' . wp_kses_post( $output ) . ' />';
			}
		}

		return $product->get_image( $image_size, $image_attr );
	}
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'leadcon_action_product_image', 20 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );

add_filter( 'woocommerce_product_add_to_cart_text', 'leadcon_custom_cart_button_text' );

if ( ! function_exists( 'leadcon_custom_cart_button_text' ) ) {
	function leadcon_custom_cart_button_text() {
		return '';
	}
}

if ( ! function_exists( 'leadcon_action_product_image' ) ) {
	function leadcon_action_product_image( $size = 'woocommerce_thumbnail', $args = array() ) {
		global $product;
		global $woocommerce;
		$size = wc_get_image_size( 'woocommerce_thumbnail' );
		$placeholder_width = $size['width'];

		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

		$gallery = $product->get_gallery_image_ids();

		if ( $product ) { ?>
		<div class="product-image-content">
			<div class="product-image-wrapper product-image-<?php echo esc_attr( $placeholder_width ); ?>">
				<?php
				/* PRODUCT IMAGE */
				// open tag <a>
				woocommerce_template_loop_product_link_open();
				echo leadcon_get_product_thumbnail();

				// close tag </a>
				woocommerce_template_loop_product_link_close();

			/* LOOP ACTION */

				?>
				<div class="leadcon-loop-action">
					<?php /*SHOW IN QUICK VIEW BTN*/ ?>
					<span data-pid="<?php echo esc_attr( $product->get_id() ); ?>" class="product-quick-view-btn leadcon-icon-quick-view"></span>
					<?php
					/*ADD TO WISHLIST BUTTON*/
						echo class_exists( 'YITH_WCWL' ) ? do_shortcode( '[yith_wcwl_add_to_wishlist]' ) : '';

					/*ADD TO CART BUTTON*/
					if ( $product && $product->is_in_stock() ) {
					$defaults = array(
						'quantity'   => 1,
						'class'      => implode( ' ', array_filter( array(
							'leadcon-add-to-cart-btn',
							'button',
							'product_type_' . $product->get_type(),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
						) ) ),
						'attributes' => array(
							'data-product_id'  => $product->get_id(),
							'data-product_sku' => $product->get_sku(),
							'aria-label'       => $product->add_to_cart_description()
							),
						);

						$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

						echo sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
							esc_url( $product->add_to_cart_url() ),
								esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
								esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
								isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
								esc_html( $product->add_to_cart_text()
							));
						}
					?>
				</div>
				<?php woocommerce_show_product_loop_sale_flash(); ?>
			</div>
		</div>

		<?php

		}
	}
}

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'leadcon_product_title', 10 );

function leadcon_product_title() {
	global $product;
	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
	echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
	echo '</a>';
}

/*! AJAX ADD TO CART
------------------------------------------------->*/
function leadcon_ajax_add_to_cart() {
	global $woocommerce;
	$total = $woocommerce->cart->cart_contents_count;
	ob_start();
	$id = $_POST['id'];
	$qty = $_POST['quantity'];
	$total =$total + (int)$qty;
	$product_status = get_post_status($id);
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $id, $qty );
	if ( $passed_validation && WC()->cart->add_to_cart($id, $qty, $id) && 'publish' === $product_status) {
		$out = ob_get_clean();
		do_action('woocommerce_ajax_added_to_cart', $id);
		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}
		?>
		<div class="cart-sidebar-head">
			<h4 class="cart-sidebar-title"><?php esc_html_e( 'Shopping cart', 'leadcon' ); ?></h4>
			<span class="count count-mini-cart"><?php echo esc_attr( $total ); ?></span>
			<button id="close-cart-sidebar" class="fa fa-close"></button>
		</div>
		<div class="cart-sidebar-content">
			<?php woocommerce_mini_cart(); ?>
		</div>
		<?php
	}
	else {
		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
		);
	}

	die();
}

add_action('wp_ajax_leadcon_ajax_add_to_cart', 'leadcon_ajax_add_to_cart');
add_action('wp_ajax_nopriv_leadcon_ajax_add_to_cart', 'leadcon_ajax_add_to_cart');


/*! UPDATE CART WHEN CLICK ADD TO CART
------------------------------------------------->*/
add_filter( 'woocommerce_add_to_cart_fragments', 'leadcon_cart_count_fragments' );

function leadcon_cart_count_fragments( $fragments ) {

	global $woocommerce;
	$total = $woocommerce->cart->cart_contents_count;
	ob_start();
	?>
	<span class="count"><?php echo esc_attr( $total ); ?></span>
	<?php
	$fragments['span.count'] = ob_get_clean();
	return $fragments;
}


/*! FONT END PRODUCT ACTION
------------------------------------------------->*/
if ( ! function_exists( 'leadcon_product_action' ) ) :
	function leadcon_product_action() {
		if ( ! class_exists( 'woocommerce' ) ) {
			return;
		}
		global $woocommerce;
		$total = $woocommerce->cart->cart_contents_count;
		?>
			<div id="shop-quick-view" data-view_id='0' data-loader="<?php echo esc_html( get_template_directory_uri() . '/assets/images/load/loading.gif'); ?> ">
			</div>
			<div id="shop-cart-sidebar">
				<div class="cart-sidebar-head">
					<h4 class="cart-sidebar-title"><?php esc_html_e( 'Shopping cart', 'leadcon' ); ?></h4>
					<span class="count"><?php echo esc_attr( $total ); ?></span>
					<button id="close-cart-sidebar" class="ion-android-close"></button>
				</div>
				<div class="cart-sidebar-content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		<div id="shop-overlay"></div>
		<?php
	}
endif;
add_action( 'leadcon_theme_core_element', 'leadcon_product_action', 10 );

function leadcon_remove_item_from_cart() {

	ob_start();
	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
	{
		if($cart_item['product_id'] == $_POST['id'] && $cart_item_key == $_POST['key'] )
		{
			WC()->cart->remove_cart_item($cart_item_key);
		}
	}

	WC()->cart->calculate_totals();
	WC()->cart->maybe_set_cart_cookies();
	woocommerce_mini_cart();
	$mini_cart = ob_get_clean();

	// Fragments and mini cart are returned
	$data = array(
		'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
			'div.cart-sidebar-content' => '<div class="cart-sidebar-content">' . $mini_cart . '</div>'
			)
		),
		'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
	);

	wp_send_json( $data );

	die();
}

add_action('wp_ajax_remove_item_from_cart', 'leadcon_remove_item_from_cart');
add_action('wp_ajax_nopriv_remove_item_from_cart', 'leadcon_remove_item_from_cart');


/*! AJAX ADD TO WHISLIST
------------------------------------------------->*/
function leadcon_ajax_add_to_whislist() {
	 global $wpdb, $sitepress;

		if( isset( $_GET['add_to_wishlist'] ) ) {
			YITH_WCWL()->add();
		}
	die();
}

add_action('wp_ajax_leadcon_add_to_whislist', 'leadcon_ajax_add_to_whislist');
add_action('wp_ajax_nopriv_leadcon_add_to_whislist', 'leadcon_ajax_add_to_whislist');


/*! AJAX QUICK VIEW
------------------------------------------------->*/
function leadcon_ajax_quick_view() {
	global $product;
	$id = $_POST['id'];
	$product = wc_get_product( $id );
	$attachment_ids = $product->get_gallery_attachment_ids();
	?>
	<div class="content-product-quick-view">
		<button class="btn-quick-view-close ion-android-close"></button>
		<div class="product-wrapper" >
			<div class="quickview-image">
				<div class="list-thumb-product js-product-thumb-quick-view">

					<?php
					if ( $product->get_type() !== 'variable' ) {
						$thumbnail = get_post_thumbnail_id( $product->id );
						$attachment = wp_get_attachment_image_src($thumbnail, array( 600, 600 ) );
					?>
					<div class="item-thumb">
						<img src="<?php echo esc_url( $attachment[0] ) ; ?>" class="card-image" >
					</div>
					<?php
					}else {
						$vars = $product->get_available_variations();
						$default_attr = method_exists( $product, 'get_default_attributes' ) ? $product->get_default_attributes() : array();
						$attributes   = $product->get_attributes();
						$image_ids = array();

						foreach( $vars as $var ) {
							foreach($var['attributes'] as $key => $attribute_value ){
								$attribute_name = str_replace( 'attribute_', '', $key );
								if ( array_key_exists( $attribute_name, $default_attr) ) {
									$default_value = $product->get_variation_default_attribute($attribute_name);
									if( $default_attr[$attribute_name] === $attribute_value ){
										array_unshift( $image_ids, $var['image_id'] );
									}
								}
							}
							if ( ! in_array($var['image_id'], $image_ids) ) {
								array_push($image_ids, $var['image_id']);
							}
						}
						foreach ($image_ids  as $attachment_id ):
							$attachment = wp_get_attachment_image_src($attachment_id, array( 600, 600 ) );
						?>
							<div class="item-thumb" data-id="<?php echo esc_attr( $attachment_id ); ?>" >
								<img src="<?php echo esc_url( $attachment[0] ); ?>" class="card-image"/>
							</div>
						<?php
						endforeach;
					}
					?>
					<?php foreach ($attachment_ids as $key => $attachment_id): ?>
						<div class="item-thumb">
							<img src="<?php echo wp_get_attachment_image_src( $attachment_id, array( 600, 600 ) )[0]; ?>" alt="<?php echo esc_attr__( 'Image Product', 'leadcon' ); ?>">
						</div>
					<?php endforeach ?>
				</div>
				<div class="btn-wishlist">
					<?php echo class_exists( 'YITH_WCWL' ) ? do_shortcode( '[yith_wcwl_add_to_wishlist]' ) : ''; ?>
				</div>
				<buttom class="buttom-slick prev button-quickview-prev ion-chevron-left"></buttom>
				<buttom class="buttom-slick next button-quickview-next ion-chevron-right"></buttom>
			</div>
			<div class="product-quickview-summary">
				<h2 class="product-title"><?php echo esc_html( $product->get_title()); ?></h2>
				<div class="quickview-product-price">
					<?php

						printf(
							wp_kses(
								/* translators: %s: comment author link */
								'%s',
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							$product->get_price_html()
						);
					?>
				</div>
				<div class="product-description">
					<?php echo esc_html( $product_full_description = $product->get_description() ); ?>
				</div>
				<?php
					woocommerce_template_single_add_to_cart();
				?>

				<div class="product_meta">

					<?php do_action( 'woocommerce_product_meta_start' ); ?>

					<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

						<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'leadcon' ); ?>
							<span class="sku"><?php echo esc_html( ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'leadcon' )); ?>
							</span>
						</span>

					<?php endif; ?>

					<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'leadcon' ) . ' ', '</span>' ); ?>

					<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'leadcon' ) . ' ', '</span>' ); ?>

					<?php do_action( 'woocommerce_product_meta_end' ); ?>

				</div>
			</div>

		<?php
	?>
		</div>
	</div>

<?php
	die();
}

add_action('wp_ajax_quick_view', 'leadcon_ajax_quick_view');
add_action('wp_ajax_nopriv_quick_view', 'leadcon_ajax_quick_view');



/*! THUMBNAIL PRODUCT SINGLE IMAGE
-------------------------------------------------*/

if ( ! function_exists( 'leadcon_show_product_image' ) ) {
	function leadcon_show_product_image($size = 'leadcon-single-product'){
		global $product;

		$attachment_ids = $product->get_gallery_image_ids();
		$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 5 );
		$post_thumbnail_id = $product->get_image_id();
		$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
		$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
		$image_size        = apply_filters( 'woocommerce_gallery_thumbnail_size', $size );
		if ( $product->is_type( 'variable' ) ) {
			$default_attr = method_exists( $product, 'get_default_attributes' ) ? $product->get_default_attributes() : array();
			$vars         = $product->get_available_variations();
			$attributes   = $product->get_attributes();

			foreach ($vars as $key => $var) {
				foreach($var['attributes'] as $key => $attribute_value ){
					$attribute_name = str_replace( 'attribute_', '', $key );
					if ( array_key_exists( $attribute_name, $default_attr) ) {
						$default_value = $product->get_variation_default_attribute($attribute_name);
						if( $default_attr[$attribute_name] === $attribute_value ){
							array_unshift( $attachment_ids, $var['image_id'] );
						}
					}
				}
				if ( ! in_array($var['image_id'], $attachment_ids) ) {
					array_push($attachment_ids, $var['image_id']);
				}
			}

		}else {
			if ( !in_array($post_thumbnail_id, $attachment_ids) ) {
				$attachment_ids[] = $post_thumbnail_id;
			}
		}

		?>

		<div class="woocommerce-product-gallery">
			<?php if ( $product->is_on_sale() ) { ?>
				<span class="onsale">Sale!</span>
			<?php } ?>
		<div class="product-image-slider">
			<div class="slider-nav">
				<?php
					if ( has_post_thumbnail() && $attachment_ids ) {
						foreach ($attachment_ids as $key => $attachment_id) {
							$image_src         = wp_get_attachment_image_src( $attachment_id,'leadcon-single-product');
							$thumbnail_src     = wp_get_attachment_image_src( $attachment_id,$thumbnail_size);
							?>
								<div class="image-list">
									<div class="img-item" data-id="<?php echo esc_attr( $attachment_id ); ?>">
										<img src="<?php echo esc_url($image_src[0]); ?>" alt="<?php echo esc_attr__( 'Image Product', 'leadcon' ); ?>" class="complete">
									</div>
								</div>
							<?php
						}
					}

				?>
			</div>

			<div class="slider-for">

				<?php
					if ( has_post_thumbnail() && $attachment_ids ) {
						foreach ($attachment_ids as $key => $attachment_id) {
							$image_src         = wp_get_attachment_image_src( $attachment_id, $size );
							$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $size );
							?>

								<div class="image-up">
									<div class="img-item"  data-id="<?php echo esc_attr( $attachment_id ); ?>">
										<a href="<?php echo esc_url($image_src[0]); ?>" class="html5lightbox" data-group="mygroup" data-thumbnail="<?php echo esc_url($image_src[0]); ?>" data-width="900" data-height="900">

											<?php
												echo wp_get_attachment_image(
													$attachment_id,
													'leadcon-single-product',
													"",
													array(
														"class" => "img-responsive",
														"alt" => $product->get_title(),
													)
												);
											?>
										</a>
									</div>
								</div>

							<?php
						}
					}

				?>
			</div>
			<buttom class="buttom-slick prev button-single-prev ion-chevron-left"></buttom>
			<buttom class="buttom-slick next button-single-next ion-chevron-right"></buttom>
			<div class="btn-wishlist">
				<?php echo class_exists( 'YITH_WCWL' ) ? do_shortcode( '[yith_wcwl_add_to_wishlist]' ) : ''; ?>
			</div>
		</div>
	</div>
		<?php
	}
}

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash',10 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images',20 );
add_action( 'woocommerce_before_single_product_summary', 'leadcon_show_product_image', 20 );



remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar' );

function leadcon_review_display_gravatar( $comment ) {

	printf(
		wp_kses(
			/* translators: %s: comment author link */
			'%s',
			array(
				'img' => array(
					'class' => array(),
					'src' => '',
					'height' => '',
					'width' => ''
				),
			)
		),
		get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '92' ), '' )
	);
}

remove_action( 'woocommerce_review_before', 'woocommerce_review_display_gravatar', 10 );

add_action( 'woocommerce_review_before', 'leadcon_review_display_gravatar', 10 );

remove_action( 'woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10 );

add_action( 'woocommerce_review_meta', 'woocommerce_review_display_rating', 15 );

// GET PRODCUT BESTSELLER
if ( ! function_exists( 'leadcon_bestseller' ) ) {
	function leadcon_bestseller() {
		global $wpdb;

		$table_orders_meta = $wpdb->prefix.'woocommerce_order_itemmeta';

		$order_meta = $wpdb->get_results( "SELECT * FROM $table_orders_meta" );

		foreach ($order_meta as $order) {

			if ( $order->meta_key === '_product_id' ) {
				$product_id = $order->meta_value;
				$order_item[$order->order_item_id]['product_id'] = $product_id;
			}
			if ( $order->meta_key === '_qty' ) {
				$qty = $order->meta_value;
				$order_item[$order->order_item_id]['qty'] = $qty;
			}
		}

		if ( empty($order_item) ) {
			return;
		}

		$bestseller = array();

		foreach ($order_item as $seller) {
			if ( empty( $bestseller ) ) {
				$bestseller[$seller['product_id'] ] = $seller['qty'] ;
			}
			else{
				if ( array_key_exists( $seller['product_id'], $bestseller) ) {
					$bestseller[$seller['product_id'] ] = $bestseller[$seller['product_id'] ] + $seller['qty'];
				}
				else {
					$bestseller[$seller['product_id'] ] = $seller['qty'] ;
				}
			}
		}
		arsort($bestseller);
		wp_reset_postdata();
		return $bestseller;
	}
}

// GET PRODCUT RENCENT
function leadcon_get_rencent_product($number) {
	$args = array(
		'numberposts' => $number,
		'post_type' => 'product',
	);
	$recent_posts = wp_get_recent_posts( $args, OBJECT );
	return $recent_posts;
}

// GET PRODCUT ONSALE
function leadcon_get_product_on_sale($products_per_page) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $products_per_page,
		'ignore_sticky_posts' => 1,
		'paged' => get_query_var('paged'),
		'post_status'       => 'publish',
		'meta_query'     => array(
			'relation' => 'OR',
			array(
				'key'     => '_sale_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'numeric'
			),
			array(
				'key'     => '_min_variation_sale_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'numeric'
			)
		)
	);

	$products = new WP_Query( $args );
	?>

	<?php

	return $products;
}

// GET PRODCUT TRENĐING
function leadcon_get_product_trending($products_per_page) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $products_per_page,
		'ignore_sticky_posts' => 1,
		'tax_query' => array(

			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'trending',
			)
		)
	);
	$loop = new WP_Query( $args );

	return $loop;
}

// GET PRODCUT POPULAR
function leadcon_get_product_popular($products_per_page) {
	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => $products_per_page,
		'ignore_sticky_posts' => 1,
		'meta_key' => 'post_views_count',//post_views_count
		'orderby' => 'meta_value_num',
		'order' => 'DESC',
	);
	$loop = new WP_Query( $args );

	return $loop;
}

// PRODUCT BESTSELLER TEMPLATE
function leadcon_product_bestseller($number) {

	$bestseller = leadcon_bestseller();
	if ( empty($bestseller) ) {
		return;
	}
	foreach ($bestseller as $id => $value) {
		$args = array(
			'post_type' => 'product',
			'p' => (int)$id
		);
		$products[] = new WP_Query( $args );
	}
	if ( empty($products) ) {
		return;
	}
	?>
	<ul class="products ht-grid tab-content tab-bestseller js-product-slider-wrapper" tab-content="bestseller">
		<?php foreach ($products as $key => $product): ?>

			<?php if ( $key < $number ):



				if ( $product->have_posts() ): ?>
					<?php

						$product->the_post();

						wc_get_template_part( 'content', 'product' );
					?>
				<?php endif ;
			endif ?>

		<?php endforeach ?>
	</ul>
	<?php
	wp_reset_postdata();
}

// PRODUCT POPULAR TEMPLATE
function leadcon_product_popular($products_per_page) {

	$products = leadcon_get_product_popular($products_per_page);
	?>
		<ul class="products ht-grid tab-content tab-popular js-product-slider-wrapper" tab-content='popular'>
		<?php while ( $products->have_posts() ): ?>
			<?php
				$products->the_post();
				wc_get_template_part( 'content', 'product' );
			?>
		<?php endwhile ?>
	</ul>
	<?php
	wp_reset_postdata();
}

// PRODUCT TRENDING TEMPLATE
function leadcon_product_trending($products_per_page) {
	$products = leadcon_get_product_trending($products_per_page);
	?>
	<ul class="products ht-grid tab-content tab-trending  js-product-slider-wrapper" tab-content='trending'>
		<?php while ( $products->have_posts() ): ?>
			<?php
				$products->the_post();
				wc_get_template_part( 'content', 'product' );
			?>
		<?php endwhile ?>
	</ul>
	<?php
}


function leadcon_product_on_sale($products_per_page) {
	$products = leadcon_get_product_on_sale($products_per_page);
	?>

		<ul class="products ht-grid tab-content tab-onsale js-product-slider-wrapper" tab-content='onsale'>

			<?php
				while ( $products->have_posts() ):
					$products->the_post();

					wc_get_template_part( 'content', 'product' );
				 endwhile;
			?>

		</ul>


	<?php
	wp_reset_postdata();
}


function leadcon_product_recent($products_per_page) {
	$products = leadcon_get_rencent_product($products_per_page);
	foreach ($products as $product) {
		$args = array(
			'post_type' => 'product',
			'p' => (int)$product->ID
		);

		$recents[] = new WP_Query( $args );

	}

	?>

		<ul class="products ht-grid tab-content tab-recent  js-product-slider-wrapper" tab-content="recent">
			<?php
				foreach ($recents as $key => $product):

					if ( $product->have_posts() ):
						$product->the_post();
						wc_get_template_part( 'content', 'product' );
					endif ;

				endforeach;
			?>
		</ul>


	<?php
	wp_reset_postdata();
}


function leadcon_get_top_rated($products_per_page) {
	global $wpdb;

	$table_product = $wpdb->prefix.'wc_product_meta_lookup';

	$products = $wpdb->get_results( "SELECT product_id FROM $table_product WHERE average_rating <> 0 ORDER BY average_rating DESC" );
	$top_rate = array();
	if ( ! $products ) {
		return;
	}
	foreach ($products as $key => $product) {

		if ( $key < (int)$products_per_page ) {
			$args = array(
				'post_type' => 'product',
				'p' => (int)$product->product_id
			);
			$top_rate[$product->product_id] = new WP_Query( $args );
		}

	}

	return $top_rate;
}

/*SWATCH LIST FOR VARIABLE PRODUCT ON ARCHIVE && PRODUCTS WIDGET*/
if( ! function_exists( 'leadcon_swatches_list' ) ) {
	function leadcon_swatches_list( $size = 'woocommerce_single' ) {
		global $product;

		$output       = '';
		$color_output = $image_output = $label_output = '';
		$pid          = $product->get_id();

		if( empty( $pid ) || ! $product->is_type( 'variable' ) ) return $output;


		$default_attr = method_exists( $product, 'get_default_attributes' ) ? $product->get_default_attributes() : array();
		$vars         = $product->get_available_variations();
		$attributes   = $product->get_attributes();

		if( empty( $attributes ) ) return $output;

		foreach( $attributes as $key ){
			/*SWATCHES TYPE, EX: `pa_size`, `pa_color`, `pz_image`...*/
			$attr_name = $key['name'];

			$terms     = wc_get_product_terms( $pid, $attr_name, array( 'fields' => 'all' ) );

			/*GET TYPE OF PRODUCT ATTRIBUTE BY ID*/
			$attr_type = wc_get_attribute( $key['id'] );

			if( empty( $terms ) ) return $output;

			$id_slug = $id_name = array();

			foreach( $terms as $val ){
				$id_slug[$val->term_id] = $val->slug;
				$id_name[$val->name]    = $val->slug;
			}

			$color     = $img_id = $label = '';
			$empty_arr = array();

			foreach( $vars as $key ){
				$slug = isset( $key['attributes']['attribute_' . $attr_name] ) ? $key['attributes']['attribute_' . $attr_name] : '';

				if( ! in_array( $slug, $empty_arr ) ) {
					array_push( $empty_arr, $slug );
				}else{
					continue;
				}

				if( empty( $slug ) ) continue;

				$_id    = array_search( $slug, $id_slug );
				$name   = array_search( $slug, $id_name );
				$src    = wp_get_attachment_image_src( $key['image_id'], $size );
				$_class = ( isset( $default_attr[$attr_name] ) && $slug == $default_attr[$attr_name] ) ? 'active' : '';

				switch( $attr_type->type ){
					case 'color':
						$color        = get_term_meta( $_id, 'color', true );
						$color_output .= '<span class="p-attr-swatch p-attr-color '. esc_attr( $_class) .'" title="'. esc_attr( $name ) .'" data-src="'. esc_attr( $src[0] ) .'" style="background-color:'. esc_attr( $color ) .'"></span>';
						break;

					case 'image':
						$img_id       = get_term_meta( $_id, 'image', true );
						$img_alt      = leadcon_img_alt( $img_id, esc_attr__( 'Swatch image', 'leadcon' ) );
						$image_output .= '<span class="p-attr-swatch p-attr-image '. esc_attr( $_class) .'" title="'. esc_attr( $name ) .'" data-src="'. esc_attr( $src[0] ) .'"><img src="' . wp_get_attachment_url( $img_id ) . '" alt="'. esc_attr( $img_alt ) .'"></span>';
						break;

					case 'label':
						$label        = get_term_meta( $_id, 'label', true );
						$label_output .= '<span class="p-attr-swatch p-attr-label '. esc_attr( $_class) .'" title="'. esc_attr( $name ) .'" data-src="'. esc_attr( $src[0] ) .'">'. esc_html( $label ) .'</span>';
						break;
				}
			}
		}

		if( ! empty( $color_output ) ){
			$output .= $color_output;
		}elseif( ! empty( $image_output ) ){
			$output .= $image_output;
		}else{
			$output .= $label_output;
		}

		return '<div class="pro-swatch-list">' . $output . '</div>';
	}
}

/* ADD SWATCHES LIST */
add_filter( 'woocommerce_after_shop_loop_item_title', 'leadcon_loop_add_to_cart', 20 );
function leadcon_loop_add_to_cart() {
	echo leadcon_swatches_list();
}

/*! AJAX SWATCH VARIATION
------------------------------------------------->*/
function leadcon_ajax_swatch_image() {
	global $product;

	$id = (int)$_GET['product_id'];
	$variation_id = (int)$_GET['variation_id'];
	$color = $_GET['attribute_pa_color'];
	$size = $_GET['attribute_pa_size'];
	$product = wc_get_product( $id );
	$vars         = $product->get_available_variations();
	$image_id = '';
	foreach ($vars as $var) {
		if ( $var['attributes']['attribute_pa_color'] == $color ) {
			$image_id = $var['image_id'];
		}
	}

	$result = json_encode( $image_id );//$image_id

	die($result);
}

add_action('wp_ajax_leadcon_swatch_image', 'leadcon_ajax_swatch_image');
add_action('wp_ajax_nopriv_leadcon_swatch_image', 'leadcon_ajax_swatch_image');

/*! AJAX ADD TO CART VARIATION
------------------------------------------------->*/

function leadcon_ajax_add_to_cart_variation() {
	global $woocommerce;
	$total = $woocommerce->cart->cart_contents_count;
	ob_start();
	$id = $_POST['id'];
	$qty = $_POST['quantity'];
	$total =$total + (int)$qty;
	$variation_id = $_POST['variation_id'];
	$variation = $_POST['variation'];

	$product_status = get_post_status($id);
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $id, $qty );

	if ( $passed_validation && WC()->cart->add_to_cart($id, $qty, $variation_id, $variation) && 'publish' === $product_status) {
		$out = ob_get_clean();
		do_action('woocommerce_ajax_added_to_cart', $id);
		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}

		?>
		<div class="cart-sidebar-head">
			<h4 class="cart-sidebar-title"><?php esc_html_e( 'Shopping cart', 'leadcon' ); ?></h4>
			<span class="count count-mini-cart"><?php echo esc_attr( $total ); ?></span>
			<button id="close-cart-sidebar" class="fa fa-close"></button>
		</div>
		<div class="cart-sidebar-content">
			<?php woocommerce_mini_cart(); ?>
		</div>

		<?php

	}
	else {
		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
		);
	}

	die();
}

add_action('wp_ajax_leadcon_ajax_add_to_cart_variation', 'leadcon_ajax_add_to_cart_variation');
add_action('wp_ajax_nopriv_leadcon_ajax_add_to_cart_variation', 'leadcon_ajax_add_to_cart_variation');

/**
 * Set post views
 */
function leadcon_set_post_views( $post_id ) {
	$count_key = 'post_views_count';
	$count     = get_post_meta( $post_id, $count_key, true );

	if ( ! $count ) {
		$count = 0;
		delete_post_meta( $post_id, $count_key );
		add_post_meta( $post_id, $count_key, $count );
	} else {
		$count++;
		update_post_meta( $post_id, $count_key, $count );
	}
}


/**
 * Track post views
 */
function leadcon_track_post_views( $post_id ) {
	if ( ! is_single() ) {
		return;
	}

	if ( empty( $post_id ) ) {
		global $post;
		$post_id = $post->ID;

		leadcon_set_post_views( $post_id );
	}
}

add_action( 'wp_head', 'leadcon_track_post_views' );


function leadcon_single_product_rating()
{
global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) : ?>

	<div class="woocommerce-product-rating">
		<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
		<?php if ( comments_open() ) : ?>
			<?php //phpcs:disable ?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
				( <?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'leadcon' ), $review_count ); ?> )
			</a>
			<?php // phpcs:enable ?>
		<?php endif ?>
	</div>

<?php
	endif;
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'leadcon_single_product_rating', 10 );
