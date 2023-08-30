<!doctype html>
<html <?php language_attributes(); ?>>
<?php wp_head() ?>
<body <?php body_class(); ?>>
<?php do_action( 'uni_after_body_opening_tag' ) ?>
<a class="skip-link" href="#uni-content" aria-label="<?php esc_attr_e('Skip to main content', 'uni') ?>">
    <?php _e('Skip to main content', 'uni') ?>
</a>
<?php do_action( 'uni_area_header' ) ?>
<main id="uni-content">