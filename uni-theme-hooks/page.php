<?php get_header(); ?>

<?php do_action( "uni_area_hero" ); ?>

<?php if ( !empty( get_the_content( get_the_ID() ) ) ) { ?>
    <article class="section">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="postContent">
                    <?php the_content() ?>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </article>
<?php } ?>

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
endif;
?>

<?php get_footer() ?>

