<?php

namespace UNI\Theme;

function get_icons_as_options( $field ) {
    if ( 'uni_social_icon' === $field['name'] ) {
        foreach ( scandir( get_template_directory() . '/static/social-icons' ) as $filename ) {
            if ( '.' !== $filename && '..' !== $filename && '.DS_Store' !== $filename ) {
                $choices[$filename] = $filename;
            }
        }
        $field['choices'] = $choices;
    }

    if ( 'uni_generic_icon' === $field['name'] ) {
        foreach ( scandir( get_template_directory() . '/static/generic-icons' ) as $filename ) {
            if ( '.' !== $filename && '..' !== $filename && '.DS_Store' !== $filename ) {
                $choices[$filename] = $filename;
            }
        }
        $field['choices'] = $choices;
    }

    if ( 'uni_theme_icon' === $field['name'] ) {
        foreach ( scandir( get_template_directory() . '/static/theme-icons' ) as $filename ) {
            if ( '.' !== $filename && '..' !== $filename && '.DS_Store' !== $filename ) {
                $choices[$filename] = $filename;
            }
        }
        $field['choices'] = $choices;
    }

    return $field;
}

function get_icon_url($type, $filename = '') {
    if ( 'uni_social_icon' === $type ) {
        return get_template_directory_uri() . '/static/social-icons/' . $filename;
    }
    if ( 'uni_generic_icon' === $type ) {
        return get_template_directory_uri() . '/static/generic-icons/' . $filename;
    }
    if ( 'uni_theme_icon' === $type ) {
        return get_template_directory_uri() . '/static/theme-icons/' . $filename;
    }

    return '';
}