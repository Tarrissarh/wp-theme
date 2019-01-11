<?php
/**
 * WP_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>

<?php

/**
 * WP_Theme only works in WordPress 5.0 or later.
 */
if (version_compare($GLOBALS['wp_version'], '5.0', '<')) {
	require get_template_directory() . '/functions/back-compat.php';
	return;
}

define('THEME_DIR', get_template_directory_uri());
define('KF_ASSETS_DIR', THEME_DIR . '/functions');

require_once 'functions/helpers.php';
require_once 'Custom_Menu_Walker.php';
require_once 'functions/third-party/acf-vendor-plugins.php';
require_once 'functions/theme_options.php';

header('X-Frame-Options: SAMEORIGIN');
header('Strict-Transport-Security: max-age=31536000');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on WP_Theme, use a find and replace
 * to change 'wp_theme' to the name of your theme in all the template files.
 */
load_theme_textdomain('wp_theme', get_template_directory() . '/languages');

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');

/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

// Remove WP version
add_filter('the_generator', '__return_empty_string');

add_filter('xmlrpc_enabled', '__return_false');

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 */
add_theme_support(
	'html5',
	[
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	]
);

/**
 * Add support for core custom logo.
 *
 * @link https://codex.wordpress.org/Theme_Logo
 */
add_theme_support(
	'custom-logo',
	[
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => false,
		'flex-height' => false,
	]
);

// Add theme support for selective refresh for widgets.
add_theme_support('customize-selective-refresh-widgets');

// Add support for Block Styles.
add_theme_support('wp-block-styles');

// Add support for full and wide align images.
add_theme_support('align-wide');

// Add support for responsive embedded content.
add_theme_support('responsive-embeds');

// Register base location for menu
add_action('after_setup_theme', 'wp_theme_register_nav_menu');

// Enabled styles and scripts
add_action('wp_enqueue_scripts', 'wp_theme_assets');

// Add dir for page template
add_filter('theme_page_templates', 'wp_theme_page_templates');

// Init new post_type and taxonomies
add_action('init', 'wp_theme_custom_data');

// Enabled widgets
add_theme_support('widgets');

// Register widgets
add_action('widgets_init', 'wp_theme_register_widgets');

// For menu in widgets
add_filter('widget_nav_menu_args', 'wp_theme_widget_nav_menu_args');

// This theme uses wp_nav_menu() in two locations.
function wp_theme_register_nav_menu()
{
	register_nav_menus([
		'top' => 'Top Menu',
		'bottom' => 'Bottom Menu'
	]);
}

/**
 * Register custom widget
 */
function wp_theme_register_widgets()
{
    register_sidebar([
        'name'          => __('Widget area', 'wp_theme'),
        'id'            => "sidebar-widget-area",
        'description'   => '',
        'class'         => '',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => "</li>\n",
        'before_title'  => '<h2 class="widget_title">',
        'after_title'   => "</h2>\n",
    ]);
}

/**
 * Add custom menu in widget
 * @param array $args
 * @return array
 */
function wp_theme_widget_nav_menu_args(array $args)
{
    return array_merge($args, [
        'container'         =>  'div',
        'container_class'   =>  'menu_footer_container',
        'container_id'      =>  '',
        'menu_class'        =>  '',
        'menu_id'           =>  '',
        'echo'              =>  true,
        'fallback_cb'       =>  '',
        'before'            =>  '',
        'after'             =>  '',
        'link_before'       =>  '',
        'link_after'        =>  '',
        'items_wrap'        =>  '<ul class="menu">%3$s</ul>',
        'depth'             =>  0,
        'walker'            =>  new Custom_Menu_Walker()
    ]);
}

/**
 * Add scripts and styles
 */
function wp_theme_assets()
{
	wp_deregister_script('jquery');

	if (is_front_page()) {
		wp_enqueue_script('scripts', THEME_DIR . '/assets/js/front.js', [], '1.0', true);
		wp_enqueue_style('styles', THEME_DIR . '/assets/css/front.css', [], '1.0');
	} else {
		wp_enqueue_script('scripts', THEME_DIR . '/assets/js/main.js', [], '1.0', true);
		wp_enqueue_style('styles', THEME_DIR . '/assets/css/main.css', [], '1.0');
	}
}

/**
 * Custom templates
 * @param array $templates
 * @return array
 */
function wp_theme_page_templates(array $templates):array
{
	$templates_dir = 'templates/page/';
	$templates_files = scandir(locate_template($templates_dir), SCANDIR_SORT_DESCENDING);

	foreach ( $templates_files as $file ) {
		if ($file == '.' || $file == '..') {
			continue;
		}

		$name = explode('.', $file);
		$templates[$templates_dir . $file] = $name[0];
	}

	return $templates;
}

/**
 * Custom post_type and taxonomies
 * @link https://wp-kama.ru/function/register_taxonomy
 * @link https://wp-kama.ru/function/register_post_type
 */
function wp_theme_custom_data()
{
	$argsTax = [
		'labels'                => [
			'name'              => __('Categories', 'wp_theme'),
			'singular_name'     => __('Category', 'wp_theme'),
			'search_items'      => __('Search categories', 'wp_theme'),
			'all_items'         => __('All categories', 'wp_theme'),
			'view_item '        => __('View category', 'wp_theme'),
			'edit_item'         => __('Edit category', 'wp_theme'),
			'update_item'       => __('Update category', 'wp_theme'),
			'add_new_item'      => __('Add category', 'wp_theme'),
            'add_new'           => __('Add category', 'wp_theme'),
			'menu_name'         => __('Categories', 'wp_theme'),
		],
		'public'                => true,
		'publicly_queryable'    => null,
		'show_in_nav_menus'     => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'show_tagcloud'         => true,
		'show_in_rest'          => true,
		'rest_base'             => null,
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		'capabilities'          => [],
		'meta_box_cb'           => null,
		'show_admin_column'     => false,
		'_builtin'              => false,
		'show_in_quick_edit'    => null,
	];

	register_taxonomy('category', ['post'], $argsTax);

	$args = [
		'labels'                =>  [
			'name'              => __('Posts', 'wp_theme'),
			'singular_name'     => __('Post', 'wp_theme'),
			'search_items'      => __('Search posts', 'wp_theme'),
			'all_items'         => __('All posts', 'wp_theme'),
			'view_item '        => __('View post', 'wp_theme'),
			'edit_item'         => __('Edit post', 'wp_theme'),
			'update_item'       => __('Update post', 'wp_theme'),
			'add_new_item'      => __('Add post', 'wp_theme'),
            'add_new'           => __('Add post', 'wp_theme'),
			'menu_name'         => __('Posts', 'wp_theme'),
		],
		'public'                =>  true,
		'publicly_queryable'    =>  true,
		'show_ui'               =>  true,
		'show_in_menu'          =>  true,
		'show_in_admin_bar'     =>  true,
		'query_var'             =>  true,
		'rewrite'               =>  true,
		'capability_type'       =>  'post',
		'has_archive'           =>  true,
		'hierarchical'          =>  false,
		'supports'              =>  ['title', 'editor', 'thumbnail', 'custom-fields', 'revisions', 'post-formats', 'excerpt'],
		'menu_position'         =>  5,
		'yarpp_support'         =>  true,
		'show_in_rest'          =>  true,
		'taxonomies'            =>  ['category'],
	];

	register_post_type('post', $args);
}