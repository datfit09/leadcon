<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package leadcon
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function leadcon_body_classes( $classes ) {
    $default_layout = get_theme_mod( 'leadcon_default_layout', 'right-sidebar' );
    $shop_layout = get_theme_mod( 'leadcon_shop_layout', 'right-sidebar' );

    // Adds a class of hfeed to non-singular pages.
    if ( class_exists( 'WooCommerce' ) ) {
        // Adds a class of no-sidebar when there is no sidebar present.
        if (is_shop() || is_product_category() || is_product_tag() ) {

            if ( ! is_active_sidebar( 'sidebar-3' ) ) {
                $classes[] = 'no-sidebar';
            }
            else {
                if ( 'no-sidebar' === $shop_layout ) {
                    $classes[] = 'no-sidebar';
                }
                if ( 'no-sidebar' !== $shop_layout ) {
                    array_push( $classes, 'has-sidebar', $shop_layout);
                }
            }

        }

        if ( is_single() && ! is_product() && is_active_sidebar( 'sidebar-1' ) ) {
            array_push( $classes, 'has-sidebar', 'right-sidebar' );
        }
    } else {
        if ( is_single() ) {
            array_push( $classes, 'has-sidebar', 'right-sidebar' );
        }
    }

    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( is_home() || is_search() || is_archive() ) {
        if ( ! is_active_sidebar( 'sidebar-1' ) || 'no-sidebar' === $default_layout ) {
            $classes[] = 'no-sidebar';
        }

    // Adds class if sidebar is used.
        if ( class_exists( 'WooCommerce' ) ) {
            if ( is_active_sidebar( 'sidebar-1' ) && ! is_shop() && 'no-sidebar' !== $default_layout ) {
                array_push( $classes, 'has-sidebar', $default_layout );
            }
        }else {
            if ( is_active_sidebar( 'sidebar-1' ) &&  'no-sidebar' !== $default_layout ) {
                array_push( $classes, 'has-sidebar', $default_layout );
            }
        }

    }

    return $classes;
}
add_filter( 'body_class', 'leadcon_body_classes' );

/**
 * Add custom class to the array of posts classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function leadcon_post_classes( $classes, $class, $post_id ) {
    if (  get_post_type($post_id) === 'post' && ! is_single() ) {
        $classes[] = 'entry';
    }

    if ( ! class_exists( 'WooCommerce' ) ) {
        return $classes;
    }

    $product = wc_get_product( $post_id );



    if ( ! is_shop() && ! is_product() && get_post_type( $post_id ) === 'product') {
        $classes[] = 'ht-grid-item';

    }

    return $classes;
}
add_filter( 'post_class', 'leadcon_post_classes', 30, 3 );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function leadcon_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'leadcon_pingback_header' );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 */
function leadcon_widget_tag_cloud_args( $args ) {
    $args['largest']  = 1;
    $args['smallest'] = 1;
    $args['unit']     = 'rem';
    $args['format']   = 'list';

    return $args;
}
add_filter( 'widget_tag_cloud_args', 'leadcon_widget_tag_cloud_args' );


function admin_style() {

    wp_enqueue_style(
        'admin-styles',
        get_template_directory_uri().'/admin.css'
    );

}
add_action('admin_enqueue_scripts', 'admin_style');

add_filter( 'wpcf7_autop_or_not', '__return_false' );


if ( ! function_exists( 'leadcon_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function leadcon_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'leadcon' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on fa fa-calendar-check-o">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'leadcon_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function leadcon_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'By %s', 'post author', 'leadcon' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline fa fa-user-o"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'leadcon_comment_count' ) ) :
    /**
     * Print HTML with the comment count for the current post
     */
    function leadcon_comment_count() {
        if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="entry-meta-item comments-link fa fa-comments-o">';
            comments_popup_link();
            echo '</span>';
        }
    }
endif;

if ( ! function_exists( 'leadcon_posted_author' ) ) {
    function leadcon_posted_author() {
        $id =  get_the_author_meta('ID');

        if ( empty( get_the_author_meta('description') ) ) {
            return ;
        }
        ?>
        <div class="author-information">
            <div class="author-avatar">
                <a href="<?php echo get_author_posts_url( $id ); ?>">
                    <?php echo get_avatar( $id, 102 ); ?>
                </a>
            </div>

            <div class="author-detail">
                <span class="writen-by"><?php echo esc_html__( 'Written by', 'leadcon' ) ?></span>
                <a href="<?php echo get_author_posts_url( $id ); ?>">
                    <h2 class="author-name"><?php echo get_the_author_meta('display_name'); ?></h2>
                </a>
                <?php if ( !empty( get_the_author_meta('description') ) ): ?>
                    <span class="author-description">
                        <?php echo get_the_author_meta('description'); ?>
                    </span>
                <?php endif ?>

            </div>
        </div>

        <?php
    }
}

if ( ! function_exists( 'leadcon_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function leadcon_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'leadcon' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tag:&nbsp; %1$s', 'leadcon' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'leadcon' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'leadcon' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'leadcon_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function leadcon_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>
        
        <div class="blog-entry-thumbnail">
    		<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
    			<?php
    			the_post_thumbnail(
    				'post-thumbnail',
    				array(
    					'alt' => the_title_attribute(
    						array(
    							'echo' => false,
    						)
    					),
    				)
    			);
    			?>
    		</a>
        </div>
			<?php
		endif; // End is_singular().
	}
endif;

/* CHECK IF ELEMENTOR IS ACTIVE
***************************************************/
if ( ! function_exists( 'leadcon_is_elementor' ) ) :
	function leadcon_is_elementor() {
		return defined( 'ELEMENTOR_VERSION' );
	}
endif;


/* CHECK IF PAGE BUILD WITH ELEMENTOR
***************************************************/
if ( ! function_exists( 'leadcon_elementor_page' ) ) :
	function leadcon_elementor_page( $id ) {
		return get_post_meta( $id, '_elementor_edit_mode', true );
	}
endif;


/**
 * Register custom query vars
 *
 * @param array $vars The array of available query variables
 */
function leadcon_register_query_vars( $vars ) {
	$vars[] = 'header_layout';

	return $vars;
}

/*
 FUNCTION SET SITE CONTAINER
 */

if ( ! function_exists( 'leadcon_site_header' ) ) {
    function leadcon_site_header() {
        $page = get_post_meta( get_the_ID(), 'container', true );
        $customize = get_theme_mod( 'site_container');

        if ( empty($page) || $page === 'default' ) {
            switch ( $customize ) {
                case 'full-width':
                    get_template_part('template-parts/header/header-full-width');
                    break;

                case 'box':
                    get_template_part('template-parts/header/header-box');
                    break;

                default:
                    get_template_part('template-parts/header/header');
                    break;
            }
        }else {
            switch ( $page ) {
                case 'full-width':
                    get_template_part('template-parts/header/header-full-width');
                    break;

                case 'box':
                    get_template_part('template-parts/header/header-box');
                    break;

                case 'container':
                    get_template_part('template-parts/header/header');
                    break;
            }
        }
    }
}

/*
 FUNCTION SET SITE CONTAINER
 */

if ( ! function_exists( 'leadcon_site_header_container_class' ) ) {
    function leadcon_site_header_container_class() {
        $page = get_post_meta( get_the_ID(), 'container', true );
        $customize = get_theme_mod( 'site_container');
        $classes = '';

        if ( empty($page) || $page === 'default' ) {
            switch ( $customize ) {
                case 'full-width':
                    $classes = 'container-fluid';
                    break;

                default:
                    $classes = 'container-extend';
                    break;
            }
        }else {
            switch ( $page ) {
                case 'full-width':
                    $classes = 'container-fluid';
                    break;

                case 'box':
                    $classes = 'container';
                    break;

                case 'container':
                    $classes = 'container';
                    break;
            }
        }

        return $classes;
    }
}

/*
 Get Header Layout Site.
 */

if ( ! function_exists( 'leadcon_get_header' ) ) {
    function leadcon_get_header() {
        $header_query = get_query_var( 'header_layout' ) ? get_query_var( 'header_layout' ) : false;

        $header_genaral = get_theme_mod( 'leadcon_header', 'header-1' );

        $header = '';

        if ( false === $header_query ) {
            switch ( $header_genaral ) {
                case 'header-2':
                    $header = get_template_part( 'template-parts/header/header-2' );
                    break;

                case 'header-3':
                    $header = get_template_part( 'template-parts/header/header-3' );
                    break;

                case 'header-4':
                    $header = get_template_part( 'template-parts/header/header-4' );
                    break;

                default:
                    $header = get_template_part( 'template-parts/header/header-1' );
                    break;
            }
        }
        else {
            $header = get_template_part( 'template-parts/header/header', $header_query );
        }

        return $header;
    }
}


if ( ! function_exists('leadcon_page_header') ) {
    function leadcon_page_header() {
        if( class_exists('acf') ) {
            $pagecpf = get_field('lc_page_header');
        }
        $global = get_theme_mod('page_header', true);
        $page = get_post_meta( get_the_ID(), 'page_header', true );

        if ( empty( $page ) ) {

            if ( true === $global ) {
                get_template_part( 'template-parts/page-header/page-header' );
            }
        }else {
            if ( ['hidden_page_header'] !== $pagecpf ) {
                get_template_part( 'template-parts/page-header/page-header' );
            }
        }
        
    }
}

/*
 FUNCTION SET CLOSE TAG FOOTER
 */

if ( ! function_exists( 'leadcon_site_close_tag_container_class' ) ) {
    function leadcon_site_close_tag_container_class() {
        $page = get_post_meta( get_the_ID(), 'container', true );
        $customize = get_theme_mod( 'site_container');
        $classes = '';

        if ( empty($page) || $page === 'default' ) {
            switch ( $customize ) {
                case 'box':
                    $classes = '</div></div>';
                    break;
            }
        }else {
            switch ( $page ) {

                case 'box':
                    $classes = '</div></div>';
                    break;
            }
        }

        return $classes;
    }
}


	/**
	 * Site search form.
	 */
if ( ! function_exists( 'leadcon_site_search' ) ) :

	function leadcon_site_search() {
		?>

		<div class="on-search" id="content-action-search">
			<div class="container">
				<div class="site-search-wrapper" aria-expanded="false" role="form">
					<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form site-search-form">
						<label for="site-search-field" class="search-label">
							<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'leadcon' ); ?></span>
						</label>
						<input type="search" id="site-search-field" class="search-field site-search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'leadcon' ); ?>" value="<?php get_search_query(); ?>" name="s">
					</form>
					<button class="site-search-close ion-android-close">
						<span class="screen-reader-text"><?php esc_html_e( 'Search', 'leadcon' ); ?></span>
					</button>
				</div><!-- .leadcon-container -->
			</div><!-- .site-search -->
		</div>
		<?php
	}
endif;


	/**
	 * Display search icon
	 */
if ( ! function_exists( 'leadcon_site_search_toggle' ) ) :

	function leadcon_site_search_toggle() {
		?>
		<div class="site-search-toggle">
			<button class="site-search-icon search-toggle js-search icon-magnifying-glass" aria-expanded="false" >

				<span class="screen-reader-text"><?php esc_html_e( 'Search for products', 'leadcon' ); ?></span>
			</button>
		</div><!-- .site-search-toggle -->
		<?php
	}
endif;
    
    /**
     * Footer Copyright.
     */
if ( ! function_exists( 'leadcon_default_footer_copyright' ) ){
    function leadcon_default_footer_copyright() {
        return sprintf( esc_html__( '&copy; %1$d Leadcon. All Rights Reserved. Designed by %2$s', 'leadcon' ), date( 'Y' ), '<a href="https://themeforest.net/user/haintheme">BoostifyThemes</a>.' );
    }
}

if ( ! function_exists( 'leadcon_the_posts_pagination' ) ) :
    /**
     * Pagination for posts.
     */
    function leadcon_the_posts_pagination() {
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => sprintf(
                    '<span><span class="screen-reader-text">%s</span>&#8249;</span>',
                    __( 'Previous set of posts', 'leadcon' )
                ),
                'next_text' => sprintf(
                    wp_kses(
                        '<span><span class="screen-reader-text">%s</span>&#8250;</span>',
                        array(
                            'span' => array( 'class' => array() ),
                        )
                    ),
                    __( 'Next set of posts', 'leadcon' )
                ),
            )
        );
    }
endif;

if ( ! function_exists( 'leadcon_the_post_navigation' ) ) :
    /**
     * Post navigation.
     */
    function leadcon_the_post_navigation() {
        // Parent post navigation.
        if ( is_singular( 'attachment' ) ) {
            the_posts_navigation(
                array(
                    /* translators: %s: parent post link */
                    'prev_text' => sprintf(
                        wp_kses(
                            __('<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'leadcon' ),
                            array(
                                'span' => array( 'class' => array() ),
                            )
                        ),
                        '%title'
                    ),
                )
            );
        } elseif ( is_singular( 'post' ) ) {
            ?>
            <div class="related-posts">
                <h2 class="related-posts-title"><?php esc_html_e( 'Related Posts', 'leadcon' ); ?></h2>
                <?php
                // Previous/next post navigation.
                $prev_post = get_previous_post();
                $next_post = get_next_post();

                $prev_post_thumbnail = $prev_post ? get_the_post_thumbnail( $prev_post->ID, array( 173, 173 ) ) : '';
                $next_post_thumbnail = $next_post ? get_the_post_thumbnail( $next_post->ID, array( 173, 173 ) ) : '';

                the_post_navigation(
                    array(
                        'next_text' => '<div><span class="meta-nav" aria-hidden="true">' . esc_attr__( 'Next Post', 'leadcon' ) . '</span>' .
                            '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'leadcon' ) . '</span><br>' .
                            '<span class="post-title">%title</span></div>' . $next_post_thumbnail,
                        'prev_text' => $prev_post_thumbnail .
                            '<div><span class="meta-nav" aria-hidden="true">' . esc_attr__( 'Prev Post', 'leadcon' ) . '</span>' .
                            '<span class="screen-reader-text">' . esc_html__( 'Previous post', 'leadcon' ) . '</span><br>' .
                            '<span class="post-title">%title</span></div>',
                    )
                );
                ?>
            </div><!-- .related-posts -->
            <?php
        }
    }
endif;


// Add Icon Elementor
function leadcon_modify_controls( $controls_registry ) {
    // Get existing icons
    $icons = $controls_registry->get_control( 'icon' )->get_settings( 'options' );
    // Append new icons
    $new_icons = array_merge(
        array(
            'icon-filter' => 'filter',
            'icon-flash' => 'flash',
            'icon-happiness' => 'happiness',
            'icon-hiker' => 'hiker',
            'icon-eiffel-tower' => 'eiffel tower',
            'icon-list-button' => 'list button',
            'icon-mail-black-envelope-symbol' => 'mail black envelope symbol',
            'icon-marina-bay-sands' => 'marina bay sands',
            'icon-phone-call' => 'phone call',
            'icon-responsive' => 'responsive',
            'icon-skiing' => 'skiing',
            'icon-statue-of-liberty' => 'statue of liberty',
            'icon-support' => 'support',
            'icon-telephone' => 'telephone',
            'icon-transparency' => 'transparency',
            'icon-treasure-map' => 'treasure map',
            'icon-world' => 'world',
            'icon-kaminarimon' => 'kaminarimon',
            'icon-tent' => 'tent',
            'icon-tour-guide' => 'tour guide',
            'icon-canoe' => 'canoe',
            'icon-layout' => 'layout',
            'icon-attach' => 'attach',
            'icon-user' => 'user',
            'icon-group' => 'group',
            'icon-placeholder' => 'placeholder',
            'icon-time-left' => 'time left',
            'icon-play-button' => 'play button',
        ),
        $icons
    );
    // Then we set a new list of icons as the options of the icon control
    $controls_registry->get_control( 'icon' )->set_settings( 'options', $new_icons );
}
add_action( 'elementor/controls/controls_registered', 'leadcon_modify_controls', 10, 1 );


// ADD ICON STYLE IN EDITOR ELEMENTOR MODE
function leadcon_enqueue_icon()
{
    wp_enqueue_style(
        'leadcon-elementor-preview-style',
        LEADCON_URI .'assets/css/flaticon.css',
        [],
        '1.0'
    );
}
add_action( 'elementor/editor/wp_head', 'leadcon_enqueue_icon' );