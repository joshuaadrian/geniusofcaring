<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */

require __DIR__ . '/lib/security/vendor/autoload.php';

$sage_includes = [
	//'lib/security/csp-headers.php',
	'lib/assets.php',                        // Scripts and stylesheets
	'lib/extras.php',                        // Custom functions
	'lib/setup.php',                         // Theme setup
	'lib/titles.php',                        // Page titles
	'lib/wrapper.php',                       // Theme wrapper class
	'lib/navwalker.php',
	'lib/gravity_forms.php',
	'lib/acf.php',
	'lib/cpts.php',
	'lib/ajax.php',
  'lib/order-within-taxonomy.php'
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
