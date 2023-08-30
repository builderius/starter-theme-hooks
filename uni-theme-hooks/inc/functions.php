<?php
if (!function_exists( 'uni__' )) {
    function uni__( $data ) {
        if ( function_exists( 'pll__' ) ) {
            return pll__( $data );
        } else {
            __( $data, 'uni' );
        }
    }
}

if (!function_exists( 'uni_e' )) {
    function uni_e( $data ) {
        if ( function_exists( 'pll_e' ) ) {
            return pll_e( $data );
        } else {
            _e( $data, 'uni' );
        }
    }
}

if (!function_exists( 'uni_get_field' )) {
    function uni_get_field( $name, $id ) {
        if ( function_exists( 'get_field' ) ) {
            return get_field( $name, $id );
        } else {
            return get_post_meta($id, $name, true);
        }
    }
}

if (!function_exists( 'uni_get_icon_url' )) {
    function uni_get_icon_url( $type, $filename = '' ) {
        return UNI\Theme\get_icon_url( $type, $filename );
    }
}

if (!function_exists( 'uni_get_proper_hook' )) {
    function uni_get_proper_hook($block) {
        $block_name = $block['acf_fc_layout'];
        $hook_name = "uni_tmpl/{$block_name}";

        if ('form_section' === $block_name) {
            $hook_name = "uni_tmpl/{$block_name}_{$block['fooorms_form']}";
        }

        do_action( $hook_name, $block );
    }
}