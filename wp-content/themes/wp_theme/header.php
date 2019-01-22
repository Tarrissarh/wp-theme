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

global $themeOptions, $assetsTheme;

$themeOptions = [];
$assetsTheme = [];

$options = getOptionFieldsFromACF(acf_get_fields('group_5c40451abaecc'));

foreach ($options as $id => $option) {
    $themeOptions[$option['name']] = get_field($option['full_name'], 'options');
}

$advanceds = acf_get_fields('group_advanced');

foreach ($advanceds as $advanced) {
    if (!in_array($advanced['type'], ['tab', 'group'])) {
        $assetsTheme[$advanced['name']] = get_field($advanced['key'], 'options');
    }
}

?>
<!Doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=wp_get_document_title();?></title>
    <!--<link rel="shortcut icon" href="assets/icons/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/icons/favicon-16x16.png">
    <link rel="manifest" href="assets/icons/site.webmanifest">
    <link rel="mask-icon" href="assets/icons/safari-pinned-tab.svg" color="#57bbd8">
    <meta name="msapplication-TileColor" content="#fbfbfb">
    <meta name="theme-color" content="#ffffff">-->

    <!--<meta property="og:title" content=""/>
    <meta property="og:description" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content=""/>
    <meta property="og:image" content=""/>-->

    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-touch-fullscreen" content="yes"/>
    <meta name="format-detection" content="telephone=no">

	<?php wp_head(); ?>

    <?php

    if (!empty($assetsTheme['opt__google_analytics'])) {
        echo $assetsTheme['opt__google_analytics'];
    }

    ?>

    <?php if (!empty($assetsTheme['opt__ScriptsBeforeHeadClose'])): ?>
        <script type="text/javascript"><?=$assetsTheme['opt__ScriptsBeforeHeadClose'];?></script>
    <?php endif; ?>
</head>

<body>
    <?php

    if (!empty($assetsTheme['opt__yandex_metrika'])) {
        echo $assetsTheme['opt__yandex_metrika'];
    }

    ?>

    <?php if (!empty($assetsTheme['opt__ScriptsAfterBodyOpen'])): ?>
        <script type="text/javascript"><?=$assetsTheme['opt__ScriptsAfterBodyOpen'];?></script>
    <?php endif; ?>

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
