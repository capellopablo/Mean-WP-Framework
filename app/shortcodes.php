<?php


add_shortcode( 'mean_modules', function (){

    if ( ! function_exists('get_field') ) return false;

    $modules = get_field('mean_modules', 'option');
    ob_start();

    if ( is_array( $modules ) ) {
        foreach ( $modules as $module ) {
            echo do_shortcode($module->post_content);
        }
    }

    return ob_get_clean();
});