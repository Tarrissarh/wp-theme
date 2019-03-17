<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */

get_header(); ?>

<?php _e('Oops! That page can&rsquo;t be found.', 'wp_theme'); ?>
<?php _e('It looks like nothing was found at this location. Maybe try a search?', 'wp_theme'); ?>
<?php get_search_form(); ?>

<?php get_footer(); ?>
