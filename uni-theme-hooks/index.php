<?php get_header(); ?>

<?php do_action( "uni_tmpl/hero_slider" ); ?>

<?php if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $post_id = get_the_ID();
        $blocks  = get_field( 'sections', $post_id );

        if ( $blocks ) {
            foreach ( $blocks as $block ) {
                uni_get_proper_hook($block);
            }
        }

    endwhile;
endif; ?>

<?php get_footer() ?>