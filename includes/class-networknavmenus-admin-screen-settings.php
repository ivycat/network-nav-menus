<?php

/**
 * Settings screen class.
 *
 * @package NetworkNavMenus
 * @since 1.0.0
 */
class NetworkNavMenus_Admin_Screen_Settings {
	/**
	 * Load the settings screen.
	 *
	 * @since 1.0.0
	 */
	public function load() {
		add_action( 'admin_menu', array( $this, 'add_menu_item' ) );
	}

	/**
	 * Add the settings menu item.
	 *
	 * @since 1.0.0
	 */
	public function add_menu_item() {
		if ( apply_filters( 'nnm_main_site_id', 1 ) == get_current_blog_id() ) {
			return;
		}

		$screen_hook = add_theme_page(
			'Network Menus',
			'Network Menus',
			'manage_options',
			'network-nav-menus',
			array( $this, 'render_screen' )
		);

		add_action( 'load-' . $screen_hook, array( $this, 'load_screen' ) );
	}

	/**
	 * Set up the setting screen.
	 *
	 * @since 1.0.0
	 */
	public function load_screen() {
		add_action( 'admin_notices', array( $this, 'screen_notices' ) );

		if ( ! isset( $_POST['nnm_nonce'] ) ) {
			return;
		}

		check_admin_referer( 'save-network-nav-menus', 'nnm_nonce' );

		$menu_locations = array_map( 'absint', $_POST['menu_locations'] );
		update_option( 'nmm_nav_menu_locations', $menu_locations );

		$args = array( 'page' => 'network-nav-menus', 'message' => 1 );
		wp_safe_redirect( add_query_arg( $args, admin_url( 'themes.php' ) ) );
		exit;
	}

	/**
	 * Display settings screen notices.
	 *
	 * @since 1.0.0
	 */
	public function screen_notices() {
		if ( empty( $_GET['message'] ) ) {
			return;
		}

		$notice = '';
		switch ( $_GET['message'] ) {
			case 1 :
				$notice = 'Network menu locations updated.';
				break;
		}

		printf( '<div class="updated"><p>%s</p></div>', esc_html( $notice ) );
	}

	/**
	 * Display the screen.
	 *
	 * @since 1.0.0
	 */
	public function render_screen() {
		$locations = get_registered_nav_menus();

		$menu_locations         = get_nav_menu_locations();
		$network_menu_locations = nnm_get_network_nav_menu_locations();

		$nav_menus = wp_get_nav_menus();
		switch_to_blog( apply_filters( 'nnm_main_site_id', 1 ) );
		$network_nav_menus = wp_get_nav_menus();
		restore_current_blog();

		include( NNM_DIR . 'views/screen-settings.php' );
	}
}
