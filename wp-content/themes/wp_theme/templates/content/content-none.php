<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.2
 */
?>

<?php _e('Nothing Found', 'wp_theme'); ?>

<?php if (is_home() && current_user_can('publish_posts')): ?>
    <?php

    printf(
        '<p>' .
        wp_kses(
            /* translators: 1: link to WP admin new post page. */
            __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp_theme'),
            [
                'a' => [
                    'href' => [],
                ],
            ]
        ) .
        '</p>',
        esc_url(admin_url('post-new.php'))
    );

    ?>
<?php elseif (is_search()): ?>
    <?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp_theme'); ?>
    <?php get_search_form(); ?>
<?php else: ?>
    <?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wp_theme'); ?>
    <?php get_search_form(); ?>
<?php endif; ?>
