<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php

/* Start the Loop */
while (have_posts()):
    the_post();

    get_template_part('template-parts/content/content', 'single');

    if (is_singular('attachment')) {
        // Parent post navigation.
        the_post_navigation(
            [
                /* translators: %s: parent post link */
                'prev_text' => sprintf(__('<span>Published in</span><span>%s</span>', 'wp_theme'), '%title'),
            ]
        );
    } elseif (is_singular('post')) {
        // Previous/next post navigation.
        the_post_navigation();
    }

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

endwhile; // End of the loop.

?>

<?php get_footer(); ?>
