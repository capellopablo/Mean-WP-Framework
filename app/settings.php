<?php
use StoutLogic\AcfBuilder\FieldsBuilder;

add_action('init', function () {

    /**
     * Global settings
     */
    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
            'page_title' 	=> 'Mean Settings',
            'menu_title'	=> 'Mean Settings',
            'menu_slug' 	=> 'mean-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

    }
});

/**
 * ACF Global Settings
 */
$fields['global_settings'] = new FieldsBuilder('global_settings');
$fields['global_settings']
    ->addTab('header', ['placement' => 'left'])
    ->addImage('logo', [
        'preview_size' => 'medium',
        'wrapper'       => [
            'width' => '75%',
        ],
    ])

    ->addTab('modules', ['placement' => 'left'])
    ->addRelationship('mean_modules',[
        'post_type' => 'et_pb_layout',
        'filters' => [],
    ])

    ->setLocation( 'options_page', '==', 'mean-settings' );

/**
 * Initiate
 */
add_action('acf/init', function () use ($fields) {
    foreach ($fields as $field) {
        acf_add_local_field_group($field->build());
    }
});