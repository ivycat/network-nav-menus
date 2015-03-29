<?php
/**
 * Uninstall routines.
 *
 * @package NetworkNavMenus
 * @since 1.0.0
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

// @todo Loop through sites to delete.
#delete_option( 'nmm_nav_menu_locations' );

// Delete site options.
$options = $wpdb->get_col( "SELECT meta_key FROM $wpdb->sitemeta WHERE meta_key LIKE 'nnm_%'" );
if ( $options ) {
	foreach ( $options as $key ) {
		delete_site_option( $key );
	}
}
