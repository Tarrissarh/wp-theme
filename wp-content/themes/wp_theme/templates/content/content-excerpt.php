<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */
?>

<?php the_ID(); ?>
<?php post_class(); ?>

<?php

if (is_sticky() && is_home() && ! is_paged()) {
    printf('<span>%s</span>', _x('Featured', 'post', 'wp_theme'));
}

the_title(sprintf('<h2><a href="%s">', esc_url( get_permalink())), '</a></h2>');

?>

<?php the_excerpt(); ?>