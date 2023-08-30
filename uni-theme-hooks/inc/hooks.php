<?php
add_filter( 'wp_head', 'UNI\\Extras\\add_resp_meta_tag', 10 );

// excerpt
add_filter( 'excerpt_more', 'UNI\\Extras\\uni_excerpt', 10 );

// acf
add_filter( 'acf/load_field', 'UNI\\Theme\\get_icons_as_options', 10, 1 );
