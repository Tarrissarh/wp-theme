<?php
/**
 * WP_Theme theme settings
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>

<?php

if (function_exists('acf_add_options_page')) {
    // Global Options
    acf_add_options_page([
        'page_title'    =>  __('WP_Theme Options', 'wp_theme'),
        'menu_title'    =>  __('WP_Theme Options', 'wp_theme'),
        'menu_slug'     =>  'theme-options',
        'position'      =>  '100',
        'capability'    =>  'edit_posts',
        'redirect'      =>  false,
    ]);

    acf_add_options_sub_page([
        'page_title'    =>  __('Advanced', 'wp_theme'),
        'menu_title'    =>  __('Advanced', 'wp_theme'),
        'parent_slug'   =>  'theme-options',
    ]);
}

if (function_exists('acf_add_local_field_group')) {
    // Styles and scripts
    acf_add_local_field_group([
        'key'                   =>  'group_advanced',
        'title'                 =>  __('Theme Options - Advanced', 'wp_theme'),
        'fields'                =>  [
            [
                'key'               =>  'field_56bf9dd0d7636',
                'label'             =>  __('Metrics', 'wp_theme'),
                'name'              =>  '',
                'type'              =>  'tab',
                'instructions'      =>  '',
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'placement'         =>  'top',
                'endpoint'          =>  0,
            ],
            [
                'key'               =>  'field_56bf9b94f0a7b',
                'label'             =>  __('Yandex.Metrika tracking code', 'wp_theme'),
                'name'              =>  'opt__yandex_metrika',
                'type'              =>  'textarea',
                'instructions'      =>  __('The code will be added after the opening tag body.<br>Added with script tag.', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'default_value'     =>  '',
                'placeholder'       =>  '',
                'maxlength'         =>  '',
                'rows'              =>  '',
                'new_lines'         =>  '',
            ],
            [
                'key'               =>  'field_56bf9c05f0a7d',
                'label'             =>  __('Google Analytics tracking code', 'wp_theme'),
                'name'              =>  'opt__google_analytics',
                'type'              =>  'textarea',
                'instructions'      =>  __('The code will be added before the closing head tag.<br>Added with script tag.', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'default_value'     =>  '',
                'placeholder'       =>  '',
                'maxlength'         =>  '',
                'rows'              =>  '',
                'new_lines'         =>  '',
            ],
            [
                'key'               =>  'field_5a09bb94eb42f',
                'label'             =>  __('Other scripts', 'wp_theme'),
                'name'              =>  '',
                'type'              =>  'tab',
                'instructions'      =>  '',
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'placement'         =>  'top',
                'endpoint'          =>  0,
            ],
            [
                'key'               =>  'field_5a09bbe4eb430',
                'label'             =>  __('Scripts before', 'wp_theme') . '&lt;/head&gt;',
                'name'              =>  'opt__ScriptsBeforeHeadClose',
                'type'              =>  'code',
                'instructions'      =>  __('The code will be added before the closing head tag.', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'language'          =>  'javascript',
                'theme'             =>  'monokai',
            ],
            [
                'key'               =>  'field_5a09bc74eb431',
                'label'             =>  __('Scripts after', 'wp_theme') . '&lt;body&gt;',
                'name'              =>  'opt__ScriptsAfterBodyOpen',
                'type'              =>  'code',
                'instructions'      =>  __('The code will be added after the opening tag body.', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'language'          =>  'javascript',
                'theme'             =>  'monokai',
            ],
            [
                'key'               =>  'field_5a09bca2eb432',
                'label'             =>  __('Scripts before', 'wp_theme') . '&lt;/body&gt;',
                'name'              =>  'opt__ScriptsBeforeBodyClose',
                'type'              =>  'code',
                'instructions'      =>  __('The code will be added before the closing body tag.', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'language'          =>  'javascript',
                'theme'             =>  'monokai',
            ],
            [
                'key'               =>  'field_56bf9de1d7637',
                'label'             =>  __('Custom css', 'wp_theme'),
                'name'              =>  '',
                'type'              =>  'tab',
                'instructions'      =>  '',
                'required'          =>  0,
                'conditional_logic' =>  0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'placement'         =>  'top',
                'endpoint'          =>  0,
            ],
            [
                'key'               =>  'field_56bf95094dcb1',
                'label'             =>  __('Custom css', 'wp_theme'),
                'name'              =>  'opt__code_css',
                'type'              =>  'code',
                'instructions'      =>  __('The option is designed to insert arbitrary css code to add new properties or change existing ones. Syntax highlighting works. The code will be added before the closing tag </head>', 'wp_theme'),
                'required'          =>  0,
                'conditional_logic' => 0,
                'wrapper'           =>  [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'language'          =>  'css',
                'theme'             =>  'monokai',
            ],
        ],
        'location'              =>  [
            [
                [
                    'param'     =>  'options_page',
                    'operator'  =>  '==',
                    'value'     =>  'acf-options-advanced',
                ],
            ],
        ],
        'menu_order'            =>  0,
        'position'              =>  'normal',
        'style'                 =>  'default',
        'label_placement'       =>  'left',
        'instruction_placement' =>  'label',
        'hide_on_screen'        =>  '',
        'active'                =>  1,
        'description'           =>  '',
    ]);
}