<?php
/**
 * Network Nav Menus
 *
 * @package NetworkNavMenus
 * @author Brady Vercher <brady@blazersix.com>
 *
 * @wordpress-plugin
 * Plugin Name: Network Nav Menus
 * Description: Assign nav menus from the main site in a network to theme locations in sub-sites.
 * Version: 1.0.1
 * Author: IvyCat, Inc.
 * Author URI: https://ivycat.com/
 */

if ( ! defined( 'NNM_DIR' ) ) {
	/**
	 * Path directory path.
	 *
	 * @since 1.0.0
	 * @type string NNM_DIR
	 */
	define( 'NNM_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'NNM_URL' ) ) {
	/**
	 * URL to the plugin's root directory.
	 *
	 * Includes trailing slash.
	 *
	 * @since 1.0.0
	 * @type string NNM_URL
	 */
	define( 'NNM_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * Include functions.
 */
include( NNM_DIR . 'includes/functions.php' );

/**
 * Autoloader callback.
 *
 * Converts a class name to a file path and requires it if it exists.
 *
 * @since 1.0.0
 *
 * @param string $class Class name.
 */
function nnm_autoloader( $class ) {
	if ( 0 !== strpos( $class, 'NetworkNavMenus' ) ) {
		return;
	}

	$file = NNM_DIR . 'includes/class-' . strtolower( str_replace( '_', '-', $class ) ) . '.php';

	if ( file_exists( $file ) ) {
		require_once( $file );
	}
}

spl_autoload_register( 'nnm_autoloader' );

$network_nav_menus = new NetworkNavMenus();
add_action( 'plugins_loaded', array( $network_nav_menus, 'load_plugin' ) );
