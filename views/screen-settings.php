<div id="network-nav-menus" class="wrap">
    <h2>Network Menus</h2>

    <div id="menu-locations-wrap">
        <form action="themes.php?page=network-nav-menus" method="post">
            <table class="widefat fixed" id="menu-locations-table">
                <thead>
                <tr>
                    <th scope="col" class="manage-column column-locations">Theme Location</th>
                    <th scope="col" class="manage-column column-network-menus">Assigned Network Menu</th>
                    <!--<th scope="col" class="manage-column column-menus">Site Menu</th>-->
                </tr>
                </thead>
                <tbody class="menu-locations">
				<?php foreach ( $locations as $location => $name ) { ?>
                    <tr id="menu-locations-row">
                        <td class="menu-location-title"><strong><?php echo $name; ?></strong></td>
                        <td class="menu-location-menus">
                            <select name="menu_locations[<?php echo $location; ?>]"
                                    id="locations-<?php echo $location; ?>">
                                <option value="0">&mdash; Select a Menu &mdash;</option>
								<?php foreach ( $network_nav_menus as $menu ) : ?>
									<?php $selected = isset( $network_menu_locations[ $location ] ) && $network_menu_locations[ $location ] == $menu->term_id; ?>
                                    <option <?php if ( $selected ) {
										echo 'data-orig="true"';
									} ?> <?php selected( $selected ); ?> value="<?php echo $menu->term_id; ?>">
										<?php echo wp_html_excerpt( $menu->name, 40, '&hellip;' ); ?>
                                    </option>
								<?php endforeach; ?>
                            </select>
                        </td>
                        <!--
							<td>
								<?php
						if ( isset( $menu_locations[ $location ] ) && ( $menu = wp_get_nav_menu_object( $menu_locations[ $location ] ) ) ) {
							echo $menu->name;
						}
						?>
							</td>
							-->
                    </tr>
				<?php } ?>
                </tbody>
            </table>
			<?php
			wp_nonce_field( 'save-network-nav-menus', 'nnm_nonce' );
			submit_button();
			?>
        </form>
    </div>
</div>

<style type="text/css">
    #network-nav-menus #menu-locations-wrap {
        margin-top: 5px;
    }
</style>
