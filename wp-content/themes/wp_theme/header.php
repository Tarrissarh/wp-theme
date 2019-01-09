<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>
<?php

global $themeOptions;
$themeOptions = get_option('wp_theme');

?>
<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--<link rel="shortcut icon" href="assets/icons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/icons/safari-pinned-tab.svg" color="#57bbd8">
    <meta name="msapplication-TileColor" content="#fbfbfb">
    <meta name="theme-color" content="#ffffff">-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php _e('Skip to content', 'wp_theme'); ?>

<?php if (is_singular()) : ?>
    <?php

    the_post_thumbnail();
    the_post();

    ?>

    <?php rewind_posts(); ?>
<?php endif; ?>

<?php

/*wp_nav_menu([
	'theme_location'  => 'primary',
	'menu'            => 'primary',
	'container'       => 'div',
	'container_class' => 'header',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => 'menu',
	'echo'            => true,
	'fallback_cb'     => '',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul class="menu" id="menu">%3$s</ul>',
	'depth'           => 0,
	'walker'          => new \Custom_Menu_Walker(),
]);*/

?>
