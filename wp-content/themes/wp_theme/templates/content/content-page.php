<?php
/**
 * Template part for displaying page content in page.php
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

the_content();

wp_link_pages(
    [
        'before' => '<div>' . __('Pages:', 'wp_theme'),
        'after'  => '</div>',
    ]
);

?>

<?php if (get_edit_post_link()): ?>
    <?php

    edit_post_link(
        sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Edit <span">%s</span>', 'wp_theme'),
                [
                    'span' => [
                        'class' => [],
                    ],
                ]
            ),
            get_the_title()
        ),
        '<span>',
        '</span>'
    );

    ?>
<?php endif; ?>
