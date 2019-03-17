<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Wordpress
 * @subpackage WP_Theme
 * @since 1.0.2
 */

global $themeOptions, $assetsTheme;

$themeOptions = get_fields('options');

?>
<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=wp_get_document_title();?></title>

	<link rel="shortcut icon" href="<?=THEME_DIR;?>/assets/icons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=THEME_DIR;?>/assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=THEME_DIR;?>/assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=THEME_DIR;?>/assets/icons/favicon-16x16.png">
    <link rel="manifest" href="<?=THEME_DIR;?>/assets/icons/site.webmanifest">
    <link rel="mask-icon" href="<?=THEME_DIR;?>/assets/icons/safari-pinned-tab.svg" color="#57bbd8">
    <meta name="msapplication-TileColor" content="#fbfbfb">
    <meta name="theme-color" content="#ffffff">

	<?php if (is_single()): ?>

		<meta property="og:title" content="<?=get_the_title();?>">
		<meta property="og:description" content="<?=get_the_excerpt();?>">
		<meta property="og:url" content="<?=get_permalink();?>">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
		<meta property="og:image" content="<?=get_the_post_thumbnail_url();?>">

	<?php else: ?>

		<meta property="og:title" content="<?=wp_get_document_title();?>">
		<meta property="og:description" content="<?php bloginfo('description'); ?>">
		<meta property="og:url" content="<?=get_home_url();?>">
		<meta property="og:type" content="website">
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>">
		<!--<meta property="og:image" content="">-->

	<?php endif; ?>

	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-touch-fullscreen" content="yes"/>
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

	<?php wp_head(); ?>

	<?php

	getStyles();
	getStylesForPage();

	getGoogleAnalytics();
	getScriptsBeforeHeadClose();

	?>

</head>
<body>

<?php

getYandexMetrica();
getScriptsAfterBodyOpen();

?>

<?php

wp_nav_menu([
	'theme_location'  => 'top',
	'menu'            => 'top',
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
]);

?>
