<?php
/**
 * Template for displaying search forms in Chameleon
 *
 * @package Wordpress
 * @subpackage WP_Theme
 * @since 1.0.2
 */
?>

<form role="search" method="get" action="<?=esc_url(home_url('/'));?>">
	<label><?php _e('Search for', 'wp_theme'); ?>:</label>
	<input type="search" name="s" value="<?=get_search_query();?>" placeholder="<?php _e('Search', 'wp_theme'); ?> &hellip;">

	<button type="submit">
		<?php _e('Search', 'wp_theme'); ?>
	</button>
</form>
