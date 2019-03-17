<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */

get_header(); ?>

<?php if (have_posts()): ?>

    <?php _e('Search results for', 'wp_theme'); ?>
    <?php echo get_search_query(); ?>

    <?php

    // Start the Loop.
    while (have_posts()):
        the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part('template-parts/content/content', 'excerpt');

        // End the loop.
    endwhile;

    // Previous/next page navigation.
    the_posts_navigation();

// If no content, include the "No posts found" template.
else:
    get_template_part('template-parts/content/content', 'none');
endif;

?>

<?php get_footer(); ?>
