<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>

<?php the_ID(); ?>
<?php post_class(); ?>

<?php

if (is_sticky() && is_home() && ! is_paged()) {
    printf('<span>%s</span>', _x('Featured', 'post', 'wp_theme'));
}

if (is_singular()):
    the_title( '<h1>', '</h1>' );
else :
    the_title(sprintf('<h2><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
endif;

?>

<?php the_post_thumbnail(); ?>

<?php

the_content(
    sprintf(
        wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
            __('Continue reading<span> "%s"</span>', 'wp_theme'),
            [
                'span' => [
                    'class' => [],
                ],
            ]
        ),
        get_the_title()
    )
);

wp_link_pages(
    [
        'before' => '<div>' . __('Pages:', 'wp_theme'),
        'after'  => '</div>',
    ]
);

?>