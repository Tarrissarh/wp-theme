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
 * @since 1.0.2
 */

global $themeOptions; ?>

    <?php wp_footer(); ?>

	<?php

	getScriptsBeforeBodyClose();
	getScriptsForPage();

	?>

</body>
</html>
