<?php
/**
 * WP_Theme back compat functionality
 *
 * Prevents WP_Theme from running on WordPress versions prior to 5.0,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 5.0.
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since WP_Theme 1.0.0
 */

/**
 * Prevent switching to WP_Theme on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since WP_Theme 1.0.0
 */
function wp_theme_switch_theme()
{
	switch_theme(WP_DEFAULT_THEME);
	unset($_GET['activated']);
	add_action('admin_notices', 'wp_theme_upgrade_notice');
}

add_action('after_switch_theme', 'wp_theme_switch_theme');

/**
 * Adds a message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * WP_Theme on WordPress versions prior to 5.0.
 *
 * @since WP_Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wp_theme_upgrade_notice()
{
	$message = sprintf(__('WP_Theme requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'wp_theme'), $GLOBALS['wp_version']);
	printf('<div class="error"><p>%s</p></div>', $message);
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 5.0.
 *
 * @since WP_Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wp_theme_customize()
{
	wp_die(
		sprintf(
			__('WP_Theme requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'wp_theme'),
			$GLOBALS['wp_version']
		),
		'',
		[
            'back_link' => true,
        ]
	);
}

add_action('load-customize.php', 'wp_theme_customize');

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 5.0.
 *
 * @since WP_Theme 1.0.0
 *
 * @global string $wp_version WordPress version.
 */
function wp_theme_preview()
{
	if (isset($_GET['preview'])) {
		wp_die(sprintf(__('WP_Theme requires at least WordPress version 5.0. You are running version %s. Please upgrade and try again.', 'wp_theme'), $GLOBALS['wp_version']));
	}
}

add_action('template_redirect', 'wp_theme_preview');