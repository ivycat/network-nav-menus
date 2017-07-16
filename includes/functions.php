<?php
/**
 * General API methods.
 *
 * @package NetworkNavMenus
 * @since 1.0.0
 */

/**
 * Retrieve network nav menu locations.
 *
 * @since 1.0.0
 *
 * @return array
 */
function nnm_get_network_nav_menu_locations() {
	$menu_locations = (array) get_option( 'nmm_nav_menu_locations' );

	return array_filter( $menu_locations );
}
