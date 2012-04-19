<?php
/*
 * Smarty plugin
 * ------------------------------------------------------------
 * Type:       function
 * Name:       cssembed
 * Purpose:    Automatically creates a <link> tag or embeds in-page CSS if small enough (performance purposes)
 * Author:     Pierre-Jean Parra
 * Version:    1.0
 *
 * ------------------------------------------------------------
 */
function smarty_function_cssembed($params, &$smarty)
{
	$url = parse_url($params['href']);
	$filename = realpath($_SERVER['DOCUMENT_ROOT'] . $url['path']);
	if ( ! isset($params['threshold'])) {
		$params['threshold'] = 10000;
	}
	
	if (isset($params['media'])) {
		$mediaQuery = ' media="' . $params['media'] . '"';
	}
	else {
		$mediaQuery = '';
	}
	
	if ($params['scoped'] === true) {
		$scoped = ' scoped';
	}
	else {
		$scoped = '';
	}

	// Big file, let's include it
	if ($params['force_embed'] !== true && filesize($filename) > $params['threshold']) {
		if ( ! empty($url['query'])) {
			$urlQuery = '?' . $url['query'];
		}
		else {
			$urlQuery = '';
		}
		return '<link rel="stylesheet"' . $mediaQuery . ' href="' . $url['path'] . $urlQuery . '">';
	}
	// Small file, let's embed it directly on the page
	else {
		return '<style' . $mediaQuery . $scoped . '>' . file_get_contents($filename) . '</style>';
	}
}

?>