<?php
function uni_get_service_icons_as_options($field) {
    if ( 'select_icon' === $field['name'] ) {
        foreach ( scandir(get_template_directory() . '/icons') as $filename ) {
            if ( '.' !== $filename && '..' !== $filename && '.DS_Store' !== $filename ) {
                $choices[$filename] = $filename;
            }
        }
        $field['choices'] = $choices;
    }

    return $field;
}