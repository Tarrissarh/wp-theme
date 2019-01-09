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

require_once 'Custom_Menu_Walker.php';

header('X-Frame-Options: SAMEORIGIN');
header('Strict-Transport-Security: max-age=31536000');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');

add_filter('xmlrpc_enabled', '__return_false');

// Remove WP version
add_filter('the_generator', '__return_empty_string');

// Connect settings for theme
locate_template('/sample/sample-config.php', true);
locate_template('/sample/barebones-config.php', true);

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
//set_post_thumbnail_size(1568, 9999);

// This theme uses wp_nav_menu() in two locations.
register_nav_menus(
	[
		'header' => __('Header menu', 'wp_theme'),
		'footer' => __('Footer Menu', 'wp_theme'),
		'social' => __('Social Links Menu', 'wp_theme'),
	]
);

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

// Enabled styles and scripts
add_action('wp_enqueue_scripts', 'assets');

function wp_theme_assets()
{
	wp_deregister_script('jquery');

	if (is_front_page()) {
		wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/front.js', array(), '1.0', true);
		wp_enqueue_style('styles', get_template_directory_uri() . '/assets/css/front.css', array(), '1.0');
	} else {
		wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0', true);
		wp_enqueue_style('styles', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');
	}
}

// Init new post_type and taxonomies
add_action('init', function() {
	$argsTax = array(
		'labels'                => [
			'name'              => __('Categories', 'wp_theme'),
			'menu_name'         => __('Categories', 'wp_theme'),
			'add_new_item'      => __('Add category', 'wp_theme'),
		],
		'description'           => '', // описание таксономии
		'public'                => true,
		'publicly_queryable'    => null, // равен аргументу public
		'show_in_nav_menus'     => true, // равен аргументу public
		'show_ui'               => true, // равен аргументу public
		'show_in_menu'          => true, // равен аргументу show_ui
		'show_tagcloud'         => true, // равен аргументу show_ui
		'show_in_rest'          => true, // добавить в REST API
		'rest_base'             => null, // $taxonomy
		'hierarchical'          => false,
		'update_count_callback' => '',
		'rewrite'               => true,
		//'query_var'             => $taxonomy, // название параметра запроса
		'capabilities'          => [],
		'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
		'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
		'_builtin'              => false,
		'show_in_quick_edit'    => null, // по умолчанию значение show_ui
	);

	register_taxonomy('category', ['post'], $argsTax);

	$args = array(
		'labels'                =>  [
			'name'      =>  __('Posts', 'wp_theme'),
			'menu_name' =>  __('Posts', 'wp_theme'),
			'add_new'   =>  __('Add post', 'wp_theme')
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
		'show_in_rest'          =>  true, // добавить в REST API
		'taxonomies'            =>  ['category'],
	);

	register_post_type('post', $args);
});