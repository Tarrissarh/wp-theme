<?php

if (!function_exists('writeToLog')) {
	/**
	 * Write content in log file
	 * @param $log
	 */
	function writeToLog($log)
	{
		if (true === WP_DEBUG) {
			if (is_array($log) || is_object($log)) {
				error_log(print_r($log, true));
			} else {
				error_log($log);
			}
		}
	}
}

/**
 * Add custom code BEFORE </head>
 */
function getScriptsBeforeHeadClose()
{
	if (get_field('opt__ScriptsBeforeHeadClose', 'options')) {
		echo '<script type="text/javascript">';
		the_field('opt__ScriptsBeforeHeadClose', 'options');
		echo '</script>';
	}
}

/**
 * Add code google analytics BEFORE </head>
 */
function getGoogleAnalytics()
{
	if (get_field('opt__google_analytics', 'options')) {
		the_field('opt__google_analytics', 'options');
	}
}

/**
 * Add code yandex metrica AFTER <body>
 */
function getYandexMetrica()
{
	if (get_field('opt__yandex_metrika', 'options')) {
		the_field('opt__yandex_metrika', 'options');
	}
}

/**
 * Add custom code AFTER <body>
 */
function getScriptsAfterBodyOpen() {
	if (get_field('opt__ScriptsAfterBodyOpen', 'options')) {
		echo '<script type="text/javascript">';
		the_field('opt__ScriptsAfterBodyOpen', 'options');
		echo '</script>';
	}
}

/**
 * Add custom code BEFORE </body>
 */
function getScriptsBeforeBodyClose() {
	if (get_field('opt__ScriptsBeforeBodyClose', 'options')) {
		echo '<script type="text/javascript">';
		the_field('opt__ScriptsBeforeBodyClose', 'options');
		echo '</script>';
	}
}

/**
 * Add js for page
 */
function getScriptsForPage()
{
	if (get_field('opt__custom_js_for_page')) {
		echo '<script type="text/javascript">';
		the_field('opt__custom_js_for_page');
		echo '</script>';
	}
}

/**
 * Add custom css
 */
function getStyles()
{
	if (get_field('opt__code_css', 'options')) {
		echo '<style>';
		the_field('opt__code_css', 'options');
		echo '</style>';
	}
}

/**
 * Add custom css for page
 */
function getStylesForPage()
{
	if (get_field('opt__custom_css_for_page')) {
		echo '<style>';
		the_field('opt__custom_css_for_page');
		echo '</style>';
	}
}