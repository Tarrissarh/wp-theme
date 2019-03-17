<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */

get_header(); ?>

<?php if (have_posts()): ?>

    <?php the_archive_title('<h1>', '</h1>'); ?>

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

    ?>
    <?php // Previous/next page navigation. ?>
    <?php the_posts_pagination(); ?>

<?php // If no content, include the "No posts found" template. ?>
<?php else: ?>
    <?php get_template_part('template-parts/content/content', 'none'); ?>
<?php endif; ?>

<?php get_footer(); ?>
