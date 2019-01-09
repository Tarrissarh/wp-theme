<?php

class Custom_Menu_Walker extends Walker_Nav_Menu
{
	function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$output .= '<li><a href="' . get_site_url() . '/' . $item->url . '">' . $item->title;
	}

	function end_el(&$output, $item, $depth = 0, $args = [])
	{
		$output .= "</a></li>";
	}
}