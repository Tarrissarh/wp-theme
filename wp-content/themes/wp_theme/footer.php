<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage WP_Theme
 * @since 1.0.0
 */
?>
    <?php global $themeOptions, $assetsTheme; ?>

    <?php wp_footer(); ?>

    <?php if (!empty($assetsTheme['opt__code_css'])): ?>
        <script type="text/javascript"><?=$assetsTheme['opt__code_css'];?></script>
    <?php endif; ?>

    <?php if (!empty($assetsTheme['opt__ScriptsBeforeBodyClose'])): ?>
        <script type="text/javascript"><?=$assetsTheme['opt__ScriptsBeforeBodyClose'];?></script>
    <?php endif; ?>

</body>
</html>
