<?php

/**
 * App Controller
 *
 * file: /app/app_controller.php
 */
class AppController extends Controller {

	/**
	 * slug()
	 * creates a slug from a string
	 */
	function slug($str) {
		// replace spaces with underscore, all to lowercase
		$str = strtolower(str_replace(' ', '_', $str));

		// create regex pattern
		$pattern = "/[^a-zA-Z0-9_]/";

		// replace non alphanumeric characters
		$str = preg_replace($pattern, '', $str);

	return $str;
	}
}

?>
