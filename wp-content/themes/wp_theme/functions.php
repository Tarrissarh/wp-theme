<?php
/**
 * WP_Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */

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

// When a document is opened in a frame, the document is rendered only when the top (top) document is from the same domain.
header('X-Frame-Options: SAMEORIGIN');
// The mechanism forcibly activating a secure connection via the HTTPS protocol
header('Strict-Transport-Security: max-age=31536000');
// May prevent some XSS attacks (“cross-site scripting”)
// (1; mode=block) XSS filter is enabled, and, in the event of an attack, prevents page processing
header('X-XSS-Protection: 1; mode=block');
// You can prevent attacks using MIME type spoofing by adding this HTTP response header
header('X-Content-Type-Options: nosniff');

/**
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on WP_Theme, use a find and replace
 * to change 'wp_theme' to the name of your theme in all the template files.
 */
load_theme_textdomain('wp_theme', get_template_directory() . '/languages');

/**
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');

/**
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
 */
add_theme_support('post-thumbnails');

/**
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

// Add theme support for selective refresh for widgets.
add_theme_support('customize-selective-refresh-widgets');

// Add support for Block Styles.
add_theme_support('wp-block-styles');

// Add support for full and wide align images.
add_theme_support('align-wide');

// Add support for responsive embedded content.
add_theme_support('responsive-embeds');

// Enabled widgets
add_theme_support('widgets');

/* FILTERS */
// Filters the output of the XHTML generator tag for display (remove WP version).
add_filter('the_generator', '__return_empty_string');

// To disable XML-RPC methods that require authentication
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Add dir for page template
 * @link https://wp-kama.ru/question/kak-dopolnit-mesta-gde-iskat-shablony-stranits
 */
add_filter('theme_page_templates', 'wp_theme_page_templates');
add_filter('theme_post_templates', 'wp_theme_post_templates');

// Register base location for menu
add_action('after_setup_theme', 'wp_theme_register_nav_menu');

// Enabled styles and scripts
add_action('wp_enqueue_scripts', 'wp_theme_assets');

// Register widgets
add_action('widgets_init', 'wp_theme_register_widgets');

// JS global variables
add_action('wp_head','js_variables');

// Remove menu
add_action('admin_menu', 'remove_menus');
add_action('wp_before_admin_bar_render', 'remove_admin_bar_links');


// This theme uses wp_nav_menu() in two locations.
function wp_theme_register_nav_menu()
{
	register_nav_menus([
		'top'       =>  'Top Menu',
		'bottom'    =>  'Bottom Menu'
	]);
}

/**
 * Register custom widget
 */
function wp_theme_register_widgets()
{
	register_sidebar([
		'name'          => __('Widget area', 'wp_theme'),
		'id'            => 'sidebar-widget-area',
		'description'   => '',
		'class'         => '',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget'  => "</li>\n",
		'before_title'  => '<h2 class="widget_title">',
		'after_title'   => "</h2>\n",
	]);
}

/**
 * Add scripts and styles
 */
function wp_theme_assets()
{
	wp_deregister_script('jquery');

	wp_enqueue_script('main-js', THEME_DIR . '/assets/js/main.js', [], '1.0', true);
	wp_enqueue_style('main-css', THEME_DIR . '/assets/css/main.css', [], '1.0');
}

/**
 * Custom templates for pages
 * @param array $templates
 * @return array
 */
function wp_theme_page_templates(array $templates):array
{
	$templates_dir = 'templates/page/';
	$templates_files = scandir(locate_template($templates_dir), SCANDIR_SORT_DESCENDING);

	foreach ( $templates_files as $file ) {
		if ($file === '.' || $file === '..') {
			continue;
		}

		$name = explode('.', $file);
		$templates[$templates_dir . $file] = $name[0];
	}

	return $templates;
}

/**
 * Custom templates for posts
 * @param array $templates
 * @return array
 */
function wp_theme_post_templates(array $templates):array
{
	$templates_dir = 'templates/post/';
	$templates_files = scandir(locate_template($templates_dir), SCANDIR_SORT_DESCENDING);

	foreach ( $templates_files as $file ) {
		if ($file === '.' || $file === '..') {
			continue;
		}

		$name = explode('.', $file);
		$templates[$templates_dir . $file] = $name[0];
	}

	return $templates;
}

/**
 * Remove menu from admin
 */
function remove_menus()
{
	remove_menu_page('edit.php');// Posts
	remove_menu_page('edit-comments.php');// Comments
}

/**
 * Remove admin bar
 */
function remove_admin_bar_links()
{
	global $wp_admin_bar;

	$wp_admin_bar->remove_menu('new-post');
}

/**
 * JS global variables
 */
function js_variables()
{
	$variables = [
		'ajax_url' => admin_url('admin-ajax.php'),
	];

	echo '<script type="text/javascript">window.wp_data = ' . json_encode($variables) . ';</script>';
}