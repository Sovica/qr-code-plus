<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://kopamnos.com
 * @since      1.0.0
 *
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Qr_Code_Plus
 * @subpackage Qr_Code_Plus/includes
 * @author     Igor <damic.igor@gmail.com>
 */
class Qr_Code_Plus_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'qr-code-plus',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
