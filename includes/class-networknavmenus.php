<?php
/**
 * Main plugin class.
 *
 * @package NetworkNavMenus
 * @since 1.0.0
 */
class NetworkNavMenus {
	/**
	 * Load the plugin.
	 *
	 * @since 1.0.0
	 */
	public function load_plugin() {
		if ( is_admin() ) {
			$this->load_admin();
		}

		add_filter( 'theme_mod_nav_menu_locations', array( $this, 'nav_menu_locations' ) );
		add_filter( 'pre_wp_nav_menu', array( $this, 'render_network_nav_menu' ), 10, 2 );
	}

	/**
	 * Load plugin administration.
	 *
	 * @since 1.0.0
	 */
	public function load_admin() {
		$settings_screen = new NetworkNavMenus_Admin_Screen_Settings();
		$settings_screen->load();

		add_action( 'wp_update_nav_menu', array( $this, 'flush_network_nav_menu_cache' ) );
	}

	/**
	 * Filter nav menu locations.
	 *
	 * Merges network locations with the site locations on the front-end. Allows
	 * templates tags like has_nav_menu() to work.
	 *
	 * @since 1.0.0
	 *
	 * @param array $locations Nav menu locations.
	 * @return array
	 */
	public function nav_menu_locations( $locations ) {
		if ( ! is_main_site() && ! is_admin() ) {
			$locations = ( ! $locations || empty( $locations ) ) ? array() : (array) $locations;
			$locations = array_merge( $locations, nnm_get_network_nav_menu_locations() );
		}

		return $locations;
	}

	/**
	 * Filter wp_nav_menu() to replace with a network nav menu if one has been
	 * assigned.
	 *
	 * @since 1.0.0
	 *
	 * @param string $output Nav menu output. Defaults to null.
	 * @param array $args Arguments for rendering the nav menu.
	 * @return string
	 */
	public function render_network_nav_menu( $output, $args ) {
		$args = (array) $args;
		$theme_location = $args['theme_location'];

		if ( is_main_site() || empty( $theme_location ) ) {
			return $output;
		}

		$locations = nnm_get_network_nav_menu_locations();
		if ( empty( $locations[ $theme_location] ) ) {
			return $output;
		}

		$nav_menu_id = $locations[ $theme_location ];
		$output = $this->get_network_nav_menu_output( $nav_menu_id, $args );

		return $output;
	}

	/**
	 * Retrieve the output for a network nav menu.
	 *
	 * Network nav menus are cached in site options so switch_to_blog() doesn't
	 * need to be called on every request. Each theme may display the nav menus
	 * slightly different, so the cache is specific to the theme. Update the nav
	 * menu in the main site to flush the cache.
	 *
	 * @since 1.0.0
	 *
	 * @param int $nav_menu_id Nav menu term id.
	 * @param array $args Arguments for rendering the nav menu.
	 * @return string
	 */
	public function get_network_nav_menu_output( $nav_menu_id, $args = array() ) {
		// @todo This should probably use $args, too.
		$cache_key = 'nnm_' . get_stylesheet() . '_' . $nav_menu_id;
		$cache = get_site_option( $cache_key );

		if ( false === $cache ) {
			switch_to_blog( 1 );
			if ( wp_get_nav_menu_object( $nav_menu_id ) ) {
				$args['echo']           = false;
				$args['menu']           = $nav_menu_id;
				$args['theme_location'] = '';

				add_filter( 'wp_nav_menu', array( $this, 'update_nav_menu_classes' ) );
				$output = wp_nav_menu( $args );
				remove_filter( 'wp_nav_menu', array( $this, 'update_nav_menu_classes' ) );
			}
			restore_current_blog();

			// Convert null to an empty string so switch_to_blog() isn't called
			// repeatedly on subsequent requests.
			$output = empty( $output ) ? '' : $output;
			update_site_option( $cache_key, $output );
		} else {
			$output = $cache;
		}

		return $output;
	}

	/**
	 * Filter final nav menu output to remove contextual classes.
	 *
	 * Classes are relative to the main site and would be cached, so they
	 * wouldn't be dynamic.
	 *
	 * @since 1.0.0
	 *
	 * @param string $nav_menu Nav menu HTML output.
	 * @return string
	 */
	public function update_nav_menu_classes( $nav_menu ) {
		$search = array(
			'current-menu-ancestor',
			'current-menu-item',
			'current-menu-parent',
			'current_page_ancestor',
			'current_page_item',
			'current_page_parent',
		);

		return str_replace( $search, '', $nav_menu );
	}

	/**
	 * Flush caches for network nav menus.
	 *
	 * @since 1.0.0
	 *
	 * @param int $nav_menu_id Nav menu term id.
	 */
	public function flush_network_nav_menu_cache( $nav_menu_id ) {
		if ( is_main_site() ) {
			foreach ( wp_get_themes() as $theme ) {
				$cache_key = 'nnm_' . $theme->get_stylesheet() . '_' . $nav_menu_id;
				delete_site_option( $cache_key );
			}
		}
	}
}
