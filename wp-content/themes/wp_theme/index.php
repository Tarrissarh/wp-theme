<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php

if (have_posts()) {
    // Load posts loop.
    while (have_posts()) {
        the_post();
        get_template_part('template-parts/content/content');
    }

    // Previous/next page navigation.
    the_posts_navigation();
} else {
    // If no content, include the "No posts found" template.
    get_template_part('templates/content/content', 'none');
}

?>

<?php get_footer(); ?>
