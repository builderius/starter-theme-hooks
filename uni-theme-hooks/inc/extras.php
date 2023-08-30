<?php

namespace UNI\Extras;

/**
 *  Adds responsive meta tag
 */
function add_resp_meta_tag() {
    ?>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1">
    <?php
}

/**
 * Custom excerpt
 */
function uni_excerpt( $length, $post_id = '', $is_echo = false, $more = null, $custom_content = null ) {
    if ( !empty( $post_id ) ) {
        $post = get_post( $post_id );
    } else {
        global $post;
    }

    $length = absint( $length );

    if ( null === $more ) {
        $more = esc_html__( '&hellip;', 'uni' );
    }

    if ( null == $custom_content ) {
        $content = $post->post_content;
    } else {
        $content = $custom_content;
    }
    $content = wp_strip_all_tags( $content );
    $content = strip_shortcodes( $content );
    if ( 'characters' == _x( 'words', 'word count: words or characters?', 'uni' ) && preg_match( '/^utf\-?8$/i', get_option( 'blog_charset' ) ) ) {
        $content = trim( preg_replace( "/[\n\r\t ]+/", ' ', $content ), ' ' );
        preg_match_all( '/./u', $content, $words_array );
        $words_array = array_slice( $words_array[0], 0, $length + 1 );
        $sep         = '';
    } else {
        $words_array = preg_split( "/[\n\r\t ]+/", $content, $length + 1, PREG_SPLIT_NO_EMPTY );
        $sep         = ' ';
    }

    if ( count( $words_array ) > $length ) {
        array_pop( $words_array );
        $content = implode( $sep, $words_array );
        $content = $content . $more;
    } else {
        $content = implode( $sep, $words_array );
    }
    if ( $is_echo ) {
        echo '<p>' . $content . '</p>';
    } else {
        return $content;
    }
}

/**
 * Sanitizes arrays/strings
 */
function uni_clean( $var ) {
    if ( is_array( $var ) ) {
        return array_map( __NAMESPACE__ . '\\uni_clean', $var );
    } else {
        return is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
    }
}

/*
 * Polylang related function for getting current language
 */
function get_cur_lang() {
    $lang_code = 'it';

    if ( function_exists( 'pll_current_language' ) ) {
        $lang_code = pll_current_language();
    }

    return $lang_code;
}

function send_curl_for_icon($url) {
    try {
        $ch = curl_init();

        if ( $ch === false ) {
            throw new \Exception('failed to initialize');
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLINFO_HEADER_OUT, false);

        $content = curl_exec($ch);

        if ( $content === false ) {
            throw new \Exception(curl_error($ch), curl_errno($ch));
        }

        return $content;

    } catch (\Exception $e) {

        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    } finally {
        if ( is_resource($ch) ) {
            curl_close($ch);
        }
    }
}

function get_the_archive_title() {
    $title  = __( 'Archives' );
    $prefix = '';

    if ( is_category() ) {
        $title  = single_cat_title( '', false );
        $prefix = _x( 'Category:', 'category archive title prefix' );
    } elseif ( is_tag() ) {
        $title  = single_tag_title( '', false );
        $prefix = _x( 'Tag:', 'tag archive title prefix' );
    } elseif ( is_author() ) {
        $title  = get_the_author();
        $prefix = _x( 'Author:', 'author archive title prefix' );
    } elseif ( is_year() ) {
        $title  = get_the_date( _x( 'Y', 'yearly archives date format' ) );
        $prefix = _x( 'Year:', 'date archive title prefix' );
    } elseif ( is_month() ) {
        $title  = get_the_date( _x( 'F Y', 'monthly archives date format' ) );
        $prefix = _x( 'Month:', 'date archive title prefix' );
    } elseif ( is_day() ) {
        $title  = get_the_date( _x( 'F j, Y', 'daily archives date format' ) );
        $prefix = _x( 'Day:', 'date archive title prefix' );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = _x( 'Asides', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = _x( 'Galleries', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = _x( 'Images', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = _x( 'Videos', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = _x( 'Quotes', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = _x( 'Links', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = _x( 'Statuses', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = _x( 'Audio', 'post format archive title' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = _x( 'Chats', 'post format archive title' );
        }
    } elseif ( is_post_type_archive() ) {
        $title  = post_type_archive_title( '', false );
        $prefix = _x( 'Archives:', 'post type archive title prefix' );
    } elseif ( is_tax() ) {
        $queried_object = get_queried_object();
        if ( $queried_object ) {
            $tax    = get_taxonomy( $queried_object->taxonomy );
            $title  = single_term_title( '', false );
            /*$prefix = sprintf(
                _x( '%s:', 'taxonomy term archive title prefix' ),
                $tax->labels->singular_name
            );*/
        }
    }

    /**
     * Filters the archive title prefix.
     *
     * @since 5.5.0
     *
     * @param string $prefix Archive title prefix.
     */
    $prefix = apply_filters( 'get_the_archive_title_prefix', $prefix );
    if ( $prefix ) {
        $title = sprintf(
        /* translators: 1: Title prefix. 2: Title. */
            _x( '%1$s %2$s', 'archive title' ),
            $prefix,
            '<span>' . $title . '</span>'
        );
    }

    return $title;
}
