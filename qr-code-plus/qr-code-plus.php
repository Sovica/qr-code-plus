<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://kopamnos.com
 * @since             1.0
 * @package           Qr_Code_Plus
 *
 * @wordpress-plugin
 * Plugin Name:       Qr Code Plus
 * Plugin URI:        http://qrcodeplus.com
 * Description:       Insert Qr codes using shortcodes or widgets to your site.
 * Version:           1.0
 * Author:            Igor Damic
 * Author URI:        http://kopamnos.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       qr-code-plus
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-qr-code-plus-activator.php
 */
function activate_qr_code_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr-code-plus-activator.php';
	Qr_Code_Plus_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-qr-code-plus-deactivator.php
 */
function deactivate_qr_code_plus() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-qr-code-plus-deactivator.php';
	Qr_Code_Plus_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_qr_code_plus' );
register_deactivation_hook( __FILE__, 'deactivate_qr_code_plus' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-qr-code-plus.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_qr_code_plus() {

	$plugin = new Qr_Code_Plus();
	$plugin->run();

}
run_qr_code_plus();
