<?php
/**
 * uni includes
 */
$uni_includes = [
    'inc/functions.php',  // Custom basic functions
    'inc/extras.php',     // Custom functions
    'inc/acf.php',        // Custom functions
    'inc/theme.php',      // Custom template related functions
    'inc/setup.php',      // Theme setup
    'inc/hooks.php',      // Collection of hooks
];

foreach ( $uni_includes as $file ) {
    if ( !$filepath = locate_template( $file ) ) {
        trigger_error( sprintf( __( 'Error locating %s for inclusion', 'uni' ), $file ), E_USER_ERROR );
    }

    require_once $filepath;
}
unset( $file, $filepath );
