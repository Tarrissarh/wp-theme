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
<?php

global $themeOptions;
$themeOptions = get_option('wp_theme');

?>

<?php $blog_info = get_bloginfo('name'); ?>

<?php if (!empty($blog_info)): ?>
    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>,
<?php endif; ?>

<?php dynamic_sidebar('sidebar-footer-menu'); ?>

<?php

if (function_exists('the_privacy_policy_link')) {
    the_privacy_policy_link('', '<span></span>');
}

?>

<?php wp_footer(); ?>

</body>
</html>
