<?php get_header(); ?>

<?php do_action( "uni_area_hero" ); ?>

<article class="section">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="postContent">
                <?php the_content() ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</article>

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

    // extra sections
    do_action( "uni_tmpl/related_articles" );
endif; ?>

<?php get_footer() ?>

