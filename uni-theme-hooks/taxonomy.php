<?php get_header();
$term    = get_queried_object();
$sections    = get_field( 'sections', $term->taxonomy . '_' . $term->term_id );
?>

<?php do_action( "uni_area_hero" ); ?>

<?php if ( !empty($sections) ) :
    foreach ( $sections as $block ) {
        uni_get_proper_hook($block);
    }
endif; ?>

<?php get_footer() ?>