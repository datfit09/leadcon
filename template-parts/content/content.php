<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package leadcon
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php leadcon_post_thumbnail(); ?>

    <div class="blog-detail">
        <header class="entry-header">

            <?php
            if ( is_sticky() && is_home() && ! is_paged() ) {
                printf( '<span class="sticky-post">%s</span>', esc_html_x( 'Featured', 'post', 'leadcon' ) );
            }

            if ( is_home() || is_archive() ) {
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            }


            if ( 'post' === get_post_type() ) :
                ?>
                <div class="blog-entry-meta<?php echo ( is_single() ? ' single-blog-meta' : ''); ?>">
                    <?php
                    leadcon_posted_on();
                    leadcon_posted_by();
                    leadcon_comment_count();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <?php if ( is_single() ) : ?>
            <div class="entry-content">
                <?php
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. Only visible to screen readers */
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'leadcon' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'leadcon' ),
                        'after'  => '</div>',
                    )
                );
                ?>
            </div><!-- .entry-content -->

            <?php leadcon_posted_author(); ?>

            <footer class="entry-footer">
                <?php leadcon_entry_footer(); ?>
            </footer><!-- .entry-footer -->

        <?php else : ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div>

        <?php endif; ?>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
